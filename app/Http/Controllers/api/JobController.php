<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\api_helper\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Models\City;
use App\Models\Job;
use App\Models\MainCategory;
use App\Models\Rate;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\ViewHistory;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\UserController;

use Illuminate\Support\Facades\Artisan;

class JobController extends Controller
{


    public function job(Job $job) {


        $jb = $job->toArray();
        $infosAll = ApiHelper::getJbInfos($job);

        return response(array_merge($jb,$infosAll), 200);
    }

    public function getAllJobs(Subcategory $subcategory, City $city,$isAuth)
    {

        $jobs = $city->jobs()->get();
        $JobInfos = [];
        foreach ($jobs as $job) {

            if ($job->subcategory_id == $subcategory->id) {

                $jb =  $job->toArray();

                $infosAll = ApiHelper::getJbInfos2($job,$isAuth);

                $JobInfos[] = array_merge($jb, $infosAll);
            }
        }


        return response($JobInfos, 200);
    }

    public function mostViewJobs(Subcategory $subcategory, City $city,$isAuth)
    {

        $jobs = $city->jobs()->get();
        $JobInfos = [];
        foreach ($jobs as $job) {

            if ($job->subcategory_id == $subcategory->id) {

                if ($job->view > 50) {

                    $jb =  $job->toArray();

                    $infosAll = ApiHelper::getJbInfos2($job,$isAuth);

                    $JobInfos[] = array_merge($jb, $infosAll);
                }
            }
        }


        return response($JobInfos, 200);
    }

    public function mostPopularJobs(Subcategory $subcategory, City $city,$isAuth)
    {

        $jobs = $city->jobs()->get();
        $JobInfos = [];
        foreach ($jobs as $job) {

            if ($job->subcategory_id == $subcategory->id) {

                if ($job->likes()->get()->count() > 20 || $job->rates($job) > 4) {

                    $jb =  $job->toArray();

                    $infosAll = ApiHelper::getJbInfos2($job,$isAuth);

                    $JobInfos[] = array_merge($jb, $infosAll);
                }
            }
        }


        return response($JobInfos, 200);
    }

    public function addView(Job $job, $ip)
    {

        $check = ViewHistory::where("job_id", $job->id)->where("user_ip", $ip)->first();
        if ($check == []) {

            ViewHistory::create([
                "job_id" => $job->id,
                'user_ip' => $ip,
            ]);

            $job->update([
                "view" => $job->view + 1,
            ]);
        } else {

            if (new DateTime(now()) > new DateTime($check->updated_at->addMinutes(60))) {

                $check->update([
                    "updated_at" => now(),
                ]);

                $job->update([
                    "view" => $job->view + 1,
                ]);
            }
        }

        return response(200);
    }

    public function addRate(Job $job, User $user, $rate)
    {

        $check = Rate::where("user_id", $user->id)->where("job_id", $job->id)->get();

        if ($check->count() == 0) {

            $newRate = $job->Rate * $job->Rate_Num;
            $newRate2 = $newRate + $rate;

            $job->update([
                'Rate_Num' => $job->Rate_Num + 1,
            ]);

            $rateAll = round(($newRate2 / $job->Rate_Num), 2);

            $job->update([
                'Rate' => $rateAll >= 5 ? 5 : $rateAll,
            ]);

            Rate::create([
                'user_id' => $user->id,
                'job_id' => $job->id,
                'rate' => $rate,
            ]);

            return response($job->Rate, 200);

        } else {

            return response('شما از قبل امتیاز خود ا ثبت کرده اید', 302);
        }
    }

    public function add(Request $request) {

        // validation
        $validation = Validator::make($request->all(), [
            "city_id" => "required",
            "subcategory_id" => "required",
            "job_name_fa" => "required",
            "job_name_en" => "required",
            "job_name_ar" => "required",
            "description_fa" => "required",
            "description_en" => "required",
            "description_ar" => "required",
            "manager_name_fa" => "required",
            "manager_name_en" => "required",
            "manager_name_ar" => "required",
            "phoneNumber" => "required",
            "address_fa" => "required",
            "address_en" => "required",
            "address_ar" => "required",
            "longitude" => "required",
            "latitude" => "required",
            "saturday_time_work" => "required",
            "sunday_time_work" => "required",
            "monday_time_work" => "required",
            "tusday_time_work" => "required",
            "wednesday_time_work" => "required",
            "thursday_time_work" => "required",
            "friday_time_work" => "required",
            "banner" => 'required|mimes:png,jpg,jpeg,webp'
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(),302);
        }

        if($this->checkJob($request->all())) {

            if ($path = Helper::uploadImg($request->file("banner"), '/Job_banners')) {

                $job = Job::create($request->except(['instagram','telegram','email','website_url','status']));
                $this->updateJob([
                    'instagram' => $request->instagram != null ? $request->instagram : '-',
                    'telegram' => $request->telegram != null ? $request->telegram : '-',
                    'email' => $request->email != null ? $request->email : '-',
                    'website_url' => $request->website_url != null ? $request->website_url : '-',
                    "status" => "تایید نشده",
                    "banner" => $path,
                    "deleted_at" => null,
                ], $job);

                return response('added',200);
            }
        }
        else {

            return response('JobExist',302);
        }
    }

    public function updateJob($list,Job $job) {
        $job->update($list);
    }

    public function edit($job,Request $request) {

        $job = Job::where('id' , $job)->withTrashed()->first();
        // validation
        $validation = Validator::make($request->all(), [
            "city_id" => "required",
            "subcategory_id" => "required",
            "job_name_fa" => "required",
            "job_name_en" => "required",
            "job_name_ar" => "required",
            "description_fa" => "required",
            "description_en" => "required",
            "description_ar" => "required",
            "manager_name_fa" => "required",
            "manager_name_en" => "required",
            "manager_name_ar" => "required",
            "phoneNumber" => "required",
            "address_fa" => "required",
            "address_en" => "required",
            "address_ar" => "required",
            "longitude" => "required",
            "latitude" => "required",
            "saturday_time_work" => "required",
            "sunday_time_work" => "required",
            "monday_time_work" => "required",
            "tusday_time_work" => "required",
            "wednesday_time_work" => "required",
            "thursday_time_work" => "required",
            "friday_time_work" => "required",
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(),302);
        }

        // update texts
        $job->update($request->except(['instagram','telegram','email','website_url','status','banner']));
        $this->updateJob([
            'instagram' => $request->instagram != null ? $request->instagram : '-',
            'telegram' => $request->telegram != null ? $request->telegram : '-',
            'email' => $request->email != null ? $request->email : '-',
            'website_url' => $request->website_url != null ? $request->website_url : '-',
            'status' => session()->has('admin') ? 'تایید شده' : 'تایید نشده',
            "deleted_at" => null,
        ], $job);

        // update image if exist
        if ($request->file("banner") != "") {

            if($request->file('banner') != $job->banner) {
                
                $validation = $request->validate([
                    "banner" => 'required|mimes:png,jpg,jpeg,webp|max:500000',
                ]);
    
                Helper::removeImg($job->banner);
    
                if ($path = Helper::uploadImg($request->file("banner"), '/Job_banners')) {
                    $job->update([
                        "banner" => $path,
                    ]);
                }  
                
            }
            
        }


        return response('edited',200);
    }

    // delete
    public function delete(Job $job,User $user)
    {
        Helper::removeImg($job->banner);

        $job->delete();
        $userController = new UserController();
        return $userController->JobList($user);
    }

    // check job
    public function checkJob($validation)
    {

        return !!Job::where("job_name_fa", $validation['job_name_fa'])->where("city_id", $validation['city_id'])->where("subcategory_id", $validation['subcategory_id'])->where("phoneNumber", $validation['phoneNumber'])->get();
    }

    public function findLoc($width,$height,Subcategory $subcategory) {

        $jobs = $subcategory->jobs()->where('status' , 'تایید شده')->get();

        $results = [];

        foreach($jobs as $job) {

            if(($job->longitude > $width + 100 || $job->longitude < $width - 100) && ($job->latitude > $height + 100 || $job->latitude < $height - 100)) {

                $results []= $job;
            }
        }


        return response($results,200);
    }

    public function getSponser(MainCategory $maincategory) {

        $sponsers = $maincategory->advertising()->where('expired_at', ">=", now())->where("payment_status", "پرداخت شده")->where("status", "تایید شده")->get();

        return response($sponsers,200);
    }
}
