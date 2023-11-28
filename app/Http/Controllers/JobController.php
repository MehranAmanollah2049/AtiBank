<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\DateHelper;
use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Job\EditPicRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobGallery;
use App\Models\MainCategory;
use App\Models\Rate;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\Ticket;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use PHPUnit\TextUI\Help;

class JobController extends Controller
{
    // add
    public function add(Request $request)
    {

        // validation
        $validation = Validator::make($request->all(), [
            "country_id" => "required",
            "state_id" => "required",
            "city_id" => "required",
            "category_id" => "required",
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
            "banner" => 'required|mimes:png,jpg,jpeg,webp|max:500000'
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        if ($this->checkJob($request->all())) {

            if ($path = Helper::uploadImg($request->file("banner"), '/Job_banners')) {

                $job = Job::create($request->except(['instagram', 'telegram', 'email', 'website_url', 'status']));
                $this->updateJob([
                    'instagram' => $request->instagram != null ? $request->instagram : '-',
                    'telegram' => $request->telegram != null ? $request->telegram : '-',
                    'email' => $request->email != null ? $request->email : '-',
                    'website_url' => $request->website_url != null ? $request->website_url : '-',
                    "status" => session()->has('admin') ? "تایید شده" : "تایید نشده",
                    "banner" => $path,
                ], $job);

                if (session()->has('admin')) {

                    Helper::msg(__('message.job_added_success'), 'success');
                } else {

                    Helper::msg(__('message.job_added_success_request'), 'success');
                }
            }
        } else {

            Helper::msg(__('message.job_exist'), 'error');
        }


        return back();
    }

    // delete
    public function delete(Job $job)
    {

        Helper::removeImg($job->banner);

        $job->delete();
        Helper::msg(__('message.jobDeleted'), 'success');
        return back();
    }

    // acceptJob
    public function acceptJob(Job $job)
    {

        $job->update([
            "status" => "تایید شده",
        ]);

        Helper::msg('شغل مورد نظر با موفقیت تایید شد', 'success');
        return back();
    }

    // search
    public function search(Request $request)
    {

        $jobs = Job::all();

        if ($request->input("searchVal") != "") {

            if (DateTime::createFromFormat('Y-m-d', $request->input("searchVal")) !== false) {

                $jobs = [];
                $jbs = Job::all();
                foreach ($jbs as $jb) {

                    if (DateHelper::FaConvert($jb->created_at) == $request->input("searchVal")) {

                        $jobs[] = $jb;
                    }
                }
            } else {

                $jobs = Job::where("job_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("status", $request->input("searchVal"))->orwhere("phoneNumber", "LIKE", "%" . $request->input("searchVal") . "%")->get();

                if ($jobs->count() == 0) {

                    $GetCountry = Country::where("country_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("country_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("country_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                    if ($GetCountry != []) {

                        $jobs = [];

                        $states = $GetCountry->states()->get();
                        foreach ($states as $state) {

                            $citys = $state->cities()->get();
                            foreach ($citys as $city) {

                                $jbs = $city->jobs()->get();
                                foreach ($jbs as $jb) {

                                    $jobs[] = $jb;
                                }
                            }
                        }
                    } else {

                        $GetState = State::where("state_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("state_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("state_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                        if ($GetState != []) {

                            $jobs = [];

                            $citys = $GetState->cities()->get();
                            foreach ($citys as $city) {

                                $jbs = $city->jobs()->get();
                                foreach ($jbs as $jb) {

                                    $jobs[] = $jb;
                                }
                            }
                        } else {

                            $GetCity = City::where("city_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("city_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("city_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                            if ($GetCity != []) {

                                $jobs = [];

                                $jbs = $GetCity->jobs()->get();
                                foreach ($jbs as $jb) {

                                    $jobs[] = $jb;
                                }
                            } else {

                                $GetMain = MainCategory::where("category_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("category_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("category_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                                if ($GetMain != []) {

                                    $jobs = [];

                                    $subs = $GetMain->subcategories()->get();
                                    foreach ($subs as $sub) {

                                        $jbs = $sub->jobs()->get();
                                        foreach ($jbs as $jb) {

                                            $jobs[] = $jb;
                                        }
                                    }
                                } else {

                                    $GetSub = Subcategory::where("subcategory_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("subcategory_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("subcategory_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                                    if ($GetSub != []) {

                                        $jobs = [];

                                        $jbs = $GetSub->jobs()->get();
                                        foreach ($jbs as $jb) {

                                            $jobs[] = $jb;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        return view("admin.Jobs.jobs", [
            "sideBar" => "jobs",
            "jobs" => $jobs,
        ]);
    }

    // edit
    public function edit(Request $request, $job)
    {

        $job = Job::where('id', $job)->withTrashed()->first();
        // validation
        $validation = Validator::make($request->all(), [
            "country_id" => "required",
            "state_id" => "required",
            "city_id" => "required",
            "category_id" => "required",
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
            Helper::msg($errors->first(), 'error');
            return back();
        }

        // update texts
        $job->update($request->except(['instagram', 'telegram', 'email', 'website_url', 'status', 'banner']));
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

            $validation = $request->validate([
                "banner" => 'required|mimes:png,jpg,jpeg,webp|max:500000'
            ]);

            Helper::removeImg($job->banner);

            if ($path = Helper::uploadImg($request->file("banner"), '/Job_banners')) {
                $job->update([
                    "banner" => $path,
                ]);
            }
        }



        if (session()->has('admin')) {

            Helper::msg(__('message.job_edited_success'), 'success');
        } else {

            Helper::msg(__('message.job_edited_success_request'), 'success');
        }
        return back();
    }

    // add_pic
    public function add_pic(Request $request, Job $job)
    {

        // validation
        $validation = Validator::make($request->all(), [
            "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000',
            'description_fa' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        if ($path = Helper::uploadImg($request->file("file"), '/Job_images')) {

            JobGallery::create([
                "job_id" => $job->id,
                "image" => $path,
                'description_fa' => $request['description_fa'],
                'description_en' => $request['description_en'],
                'description_ar' => $request['description_ar'],
                "status" => session()->has("admin") ? "تایید شده" : "تایید نشده",
            ]);

            Helper::msg(__('message.job_image_added'), 'success');
        }


        return back();
    }

    // edit_pic
    public function edit_pic(EditPicRequest $request, JobGallery $jobgallery)
    {

        $validation = $request->validated();

        // update texts
        $jobgallery->update($validation);

        // update image
        if ($request->file('file') != null) {

            $validation = $request->validate([
                "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000'
            ]);

            Helper::RemoveImg($jobgallery->image);

            if ($path = Helper::uploadImg($request->file("file"), '/Job_images')) {

                $jobgallery->update([
                    "image" => $path,
                ]);
            }
        }


        Helper::msg('اطلاعات مورد نظر با موفقیت ویرایش شد', 'success');
        return back();
    }

    // delete_pic
    public function delete_pic(JobGallery $jobgallery)
    {

        Helper::RemoveImg($jobgallery->image);

        $jobgallery->delete();

        Helper::msg(__('message.deletedImagesJob'), 'success');
        return back();
    }

    // accept image galleries
    public function accept(JobGallery $jobgallery)
    {

        $jobgallery->update([
            "status" => 'تایید شده',
        ]);

        Helper::msg("عکس مورد نظر با موفقیت تایید شد", "success");
        return back();
    }

    // check job
    public function checkJob($validation)
    {

        return !!Job::where("job_name_fa", $validation['job_name_fa'])->where("city_id", $validation['city_id'])->where("subcategory_id", $validation['subcategory_id'])->where("phoneNumber", $validation['phoneNumber'])->get();
    }

    public function updateJob(array $arr, $job)
    {

        $job->update($arr);
    }


    public function Filters(Request $request)
    {


        $AllJobs = [];

        $controversial_num = 10;
        $likesNum = 10;
        $ratesNum = 4;


        if (count($request->all()) != 0 && !(count($request->all()) == 1 && $this->checkFilter($request->page))) {

            if ($this->checkFilter($request->country) && !$this->checkFilter($request->state) && !$this->checkFilter($request->city) && !$this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->orderBy("id", "DESC")->get();
                            foreach ($jobs as $jb) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                $JobObj = new Job();
                                if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && $this->checkFilter($request->state) && !$this->checkFilter($request->city) && !$this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->orderBy("id", "DESC")->get();
                        foreach ($jobs as $jb) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            $JobObj = new Job();
                            if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else {


                    $cities = State::where("id", $request->state)->first()->cities()->get();

                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            $AllJobs[] = $jb;
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && $this->checkFilter($request->state) && $this->checkFilter($request->city) && !$this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->orderBy("id", "DESC")->get();
                    foreach ($jobs as $jb) {

                        $AllJobs[] = $jb;
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $JobObj = new Job();
                        if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $AllJobs[] = $jb;
                    }
                }
            } else if (!$this->checkFilter($request->country) && !$this->checkFilter($request->state) && !$this->checkFilter($request->city) && $this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $subs = MainCategory::where("id", $request->category)->first()->subcategories()->get();
                    foreach ($subs as $sub) {

                        $jobs = $sub->jobs()->orderBy("id", "DESC")->get();
                        foreach ($jobs as $jb) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $subs = MainCategory::where("id", $request->category)->first()->subcategories()->get();
                    foreach ($subs as $sub) {

                        $jobs = $sub->jobs()->get();
                        foreach ($jobs as $jb) {

                            $JobObj = new Job();
                            if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $subs = MainCategory::where("id", $request->category)->first()->subcategories()->get();
                    foreach ($subs as $sub) {

                        $jobs = $sub->jobs()->get();
                        foreach ($jobs as $jb) {

                            if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else {

                    $subs = MainCategory::where("id", $request->category)->first()->subcategories()->get();
                    foreach ($subs as $sub) {

                        $jobs = $sub->jobs()->get();
                        foreach ($jobs as $jb) {

                            $AllJobs[] = $jb;
                        }
                    }
                }
            } else if (!$this->checkFilter($request->country) && !$this->checkFilter($request->state) && !$this->checkFilter($request->city) && $this->checkFilter($request->category) && $this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $jobs = Subcategory::where("id", $request->subcategory)->first()->jobs()->orderBy("id", "DESC")->get();
                    foreach ($jobs as $jb) {

                        $AllJobs[] = $jb;
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $jobs = Subcategory::where("id", $request->subcategory)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $JobObj = new Job();
                        if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $jobs = Subcategory::where("id", $request->subcategory)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else {

                    $jobs = Subcategory::where("id", $request->subcategory)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $AllJobs[] = $jb;
                    }
                }
            } else if ($this->checkFilter($request->country) && !$this->checkFilter($request->state) && !$this->checkFilter($request->city) && $this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->orderBy("id", "DESC")->get();
                            foreach ($jobs as $jb) {

                                $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                                if ($request->category == $sub->category_id) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                                if ($request->category == $sub->category_id) {

                                    $JobObj = new Job();
                                    if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                        $AllJobs[] = $jb;
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                                if ($request->category == $sub->category_id) {

                                    if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                        $AllJobs[] = $jb;
                                    }
                                }
                            }
                        }
                    }
                } else {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                                if ($request->category == $sub->category_id) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && !$this->checkFilter($request->state) && !$this->checkFilter($request->city) && $this->checkFilter($request->category) && $this->checkFilter($request->subcategory)) {


                if ($this->checkFilter($request->newest)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->orderBy("id", "DESC")->get();
                            foreach ($jobs as $jb) {

                                if ($request->subcategory == $jb->subcategory_id) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                if ($request->subcategory == $jb->subcategory_id) {

                                    $JobObj = new Job();
                                    if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                        $AllJobs[] = $jb;
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                if ($request->subcategory == $jb->subcategory_id) {

                                    if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                        $AllJobs[] = $jb;
                                    }
                                }
                            }
                        }
                    }
                } else {

                    $states = Country::where("id", $request->country)->first()->states()->get();
                    foreach ($states as $state) {

                        $cities = $state->cities()->get();
                        foreach ($cities as $city) {

                            $jobs = $city->jobs()->get();
                            foreach ($jobs as $jb) {

                                if ($request->subcategory == $jb->subcategory_id) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && $this->checkFilter($request->state) && !$this->checkFilter($request->city) && $this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->orderBy("id", "DESC")->get();
                        foreach ($jobs as $jb) {

                            $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                            if ($request->category == $sub->category_id) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                            if ($request->category == $sub->category_id) {

                                $JobObj = new Job();
                                if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                            if ($request->category == $sub->category_id) {

                                if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                            if ($request->category == $sub->category_id) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && $this->checkFilter($request->state) && !$this->checkFilter($request->city) && $this->checkFilter($request->category) && $this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->orderBy("id", "DESC")->get();
                        foreach ($jobs as $jb) {

                            if ($request->subcategory == $jb->subcategory_id) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            if ($request->subcategory == $jb->subcategory_id) {

                                $JobObj = new Job();
                                if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            if ($request->subcategory == $jb->subcategory_id) {

                                if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                    $AllJobs[] = $jb;
                                }
                            }
                        }
                    }
                } else {

                    $cities = State::where("id", $request->state)->first()->cities()->get();
                    foreach ($cities as $city) {

                        $jobs = $city->jobs()->get();
                        foreach ($jobs as $jb) {

                            if ($request->subcategory == $jb->subcategory_id) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && $this->checkFilter($request->state) && $this->checkFilter($request->city) && $this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->orderBy("id", "DESC")->get();
                    foreach ($jobs as $jb) {

                        $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                        if ($request->category == $sub->category_id) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                        if ($request->category == $sub->category_id) {

                            $JobObj = new Job();
                            if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                        if ($request->category == $sub->category_id) {

                            if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        $sub = Subcategory::where("id", $jb->subcategory_id)->first();
                        if ($request->category == $sub->category_id) {

                            $AllJobs[] = $jb;
                        }
                    }
                }
            } else if ($this->checkFilter($request->country) && $this->checkFilter($request->state) && $this->checkFilter($request->city) && $this->checkFilter($request->category) && $this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->orderBy("id", "DESC")->get();
                    foreach ($jobs as $jb) {

                        if ($request->subcategory == $jb->subcategory_id) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        if ($request->subcategory == $jb->subcategory_id) {

                            $JobObj = new Job();
                            if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        if ($request->subcategory == $jb->subcategory_id) {

                            if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                                $AllJobs[] = $jb;
                            }
                        }
                    }
                } else {

                    $jobs = City::where("id", $request->city)->first()->jobs()->get();
                    foreach ($jobs as $jb) {

                        if ($request->subcategory == $jb->subcategory_id) {

                            $AllJobs[] = $jb;
                        }
                    }
                }
            } else if (!$this->checkFilter($request->country) && !$this->checkFilter($request->state) && !$this->checkFilter($request->city) && !$this->checkFilter($request->category) && !$this->checkFilter($request->subcategory)) {

                if ($this->checkFilter($request->newest)) {

                    $jobs = Job::where("status", "تایید شده")->orderBy("id", "DESC")->get();
                    foreach ($jobs as $jb) {

                        $AllJobs[] = $jb;
                    }
                } else if ($this->checkFilter($request->controversial)) {

                    $jobs = Job::where("status", "تایید شده")->get();
                    foreach ($jobs as $jb) {

                        $JobObj = new Job();
                        if ($JobObj->getCommentsNum($jb->id) > $controversial_num) {

                            $AllJobs[] = $jb;
                        }
                    }
                } else if ($this->checkFilter($request->populer)) {

                    $jobs = Job::where("status", "تایید شده")->get();
                    foreach ($jobs as $jb) {

                        if ($jb->likes()->get()->count() > $likesNum || $jb->rates() > $ratesNum) {

                            $AllJobs[] = $jb;
                        }
                    }
                }
            }
        } else {

            Helper::msg(__("message.filterNotFound"), 'error');
            return redirect()->route('AllJobs');
        }

        if (count($AllJobs) != 0) {

            $AllJobsResult = (new Collection($AllJobs))->paginate(9);
        } else {

            Helper::msg(__('message.NotFound'), 'error');
            $emptyResults = __('message.NotFound');
            $AllJobsResult = "<div class='emptyResults'>$emptyResults</div>";
        }


        return view("website.AllJobs", [
            'Jobs' => $AllJobsResult,
        ]);
    }

    public function checkFilter($item)
    {

        if (isset($item) && $item != null) {

            return true;
        }

        return false;
    }


    public function filterEmpty($type)
    {

        if ($type == "country") {

            $empty =  __('message.choose_country');
        } else if ($type == "state") {

            $empty =  __('message.choose_state');
        } else if ($type == "sub") {

            $empty =  __('message.choose_category');
        }


        return "<div class='empty_filter'>$empty</div>";
    }


    public function addRate(Job $job, $rate)
    {

        $resultAll = [];

        if (auth()->check()) {

            $check = Rate::where("user_id", auth()->user()->id)->where("job_id", $job->id)->get();

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
                    'user_id' => auth()->user()->id,
                    'job_id' => $job->id,
                    'rate' => $rate,
                ]);

                $resultAll = [__('message.rateText', ['rateNum' => $job->Rate, 'allRate' => $job->Rate_Num]), $job->Rate, __('message.RateAdded')];
            } else {

                $resultAll = [__('message.YouRated')];
            }
        } else {

            $resultAll = [__('message.addCommentBtn2')];
        }

        return join("|", $resultAll);
    }

    public function getAllRateText($job_id)
    {

        $Rate = new Rate();
        return $Rate->getRateText($job_id);
    }

    public function getAVG($job_id)
    {

        $Rate = new Rate();
        $allrates = $Rate->SelectRate($job_id);
        return $Rate->getAvg($allrates);
    }


    public function serachForJob($val)
    {


        if ($val !== '' && $val !== null) {

            $jobs = [];

            $jobs = Job::where("job_name_fa", "LIKE", "%" . $val . "%")->orwhere("job_name_en", "LIKE", "%" . $val . "%")->orwhere("job_name_ar", "LIKE", "%" . $val . "%")->orwhere("status", $val)->orwhere("phoneNumber", "LIKE", "%" . $val . "%")->get();

            if ($jobs->count() == 0) {

                $GetCountry = Country::where("country_name_fa", "LIKE", "%" . $val . "%")->orwhere("country_name_en", "LIKE", "%" . $val . "%")->orwhere("country_name_ar", "LIKE", "%" . $val . "%")->first();

                if ($GetCountry != []) {

                    $jobs = [];

                    $states = $GetCountry->states()->get();
                    foreach ($states as $state) {

                        $citys = $state->cities()->get();
                        foreach ($citys as $city) {

                            $jbs = $city->jobs()->get();
                            foreach ($jbs as $jb) {

                                $jobs[] = $jb;
                            }
                        }
                    }
                } else {

                    $GetState = State::where("state_name_fa", "LIKE", "%" . $val . "%")->orwhere("state_name_en", "LIKE", "%" . $val . "%")->orwhere("state_name_ar", "LIKE", "%" . $val . "%")->first();

                    if ($GetState != []) {

                        $jobs = [];

                        $citys = $GetState->cities()->get();
                        foreach ($citys as $city) {

                            $jbs = $city->jobs()->get();
                            foreach ($jbs as $jb) {

                                $jobs[] = $jb;
                            }
                        }
                    } else {

                        $GetCity = City::where("city_name_fa", "LIKE", "%" . $val . "%")->orwhere("city_name_en", "LIKE", "%" . $val . "%")->orwhere("city_name_ar", "LIKE", "%" . $val . "%")->first();

                        if ($GetCity != []) {

                            $jobs = [];

                            $jbs = $GetCity->jobs()->get();
                            foreach ($jbs as $jb) {

                                $jobs[] = $jb;
                            }
                        } else {

                            $GetMain = MainCategory::where("category_name_fa", "LIKE", "%" . $val . "%")->orwhere("category_name_en", "LIKE", "%" . $val . "%")->orwhere("category_name_ar", "LIKE", "%" . $val . "%")->first();

                            if ($GetMain != []) {

                                $jobs = [];

                                $subs = $GetMain->subcategories()->get();
                                foreach ($subs as $sub) {

                                    $jbs = $sub->jobs()->get();
                                    foreach ($jbs as $jb) {

                                        $jobs[] = $jb;
                                    }
                                }
                            } else {

                                $GetSub = Subcategory::where("subcategory_name_fa", "LIKE", "%" . $val . "%")->orwhere("subcategory_name_en", "LIKE", "%" . $val . "%")->orwhere("subcategory_name_ar", "LIKE", "%" . $val . "%")->first();

                                if ($GetSub != []) {

                                    $jobs = [];

                                    $jbs = $GetSub->jobs()->get();
                                    foreach ($jbs as $jb) {

                                        $jobs[] = $jb;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (count($jobs) > 0) {

                foreach ($jobs as $jb) {

                    $name = $jb->{'job_name_' . session('lang')};
                    $id = $jb->id;
                    $likes = $jb->likes()->get()->count();
                    $cmt = $jb->getCommentsNum($jb->id);

                    $Result[] = "<div class='result_search'>
                <a href='/Job/$id'>
                    <div class='right_result'>
                    <ion-icon name='briefcase-outline'></ion-icon>
                        <p class='result_title'>$name</p>
                    </div>
                    <div class='left_result'>
                        <div class='like_result_num'>
                            <svg viewBox='0 0 13 11' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke='currentColor' d='M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z' stroke-width='0.761705'></path>
                            </svg>
                            $likes
                        </div>
                        <div class='comment_result_num'>
                            <svg viewBox='0 0 12 12' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M5.99646 0.827528C7.17456 0.827528 8.09169 0.881027 8.80899 1.01903C9.52386 1.15656 10.0045 1.37154 10.3411 1.66825C11.0098 2.25772 11.2804 3.32306 11.2804 5.47101C11.2804 6.85518 11.1561 7.87367 10.8215 8.53718C10.661 8.85564 10.4576 9.07995 10.2017 9.22916C9.94304 9.37996 9.59628 9.474 9.11892 9.474C8.5035 9.474 8.0416 9.61219 7.68041 9.85692C7.32786 10.0958 7.11521 10.4085 6.95703 10.6574C6.9331 10.6951 6.91069 10.7307 6.88949 10.7643C6.75685 10.9749 6.67103 11.1111 6.55187 11.2181C6.44568 11.3134 6.29728 11.3954 5.99659 11.3954C5.69593 11.3954 5.54754 11.3133 5.44133 11.218C5.32218 11.1111 5.23635 10.9749 5.10373 10.7643C5.08251 10.7307 5.0601 10.6951 5.03616 10.6574C4.87797 10.4085 4.66531 10.0958 4.31276 9.8569C3.95156 9.61218 3.48966 9.474 2.87424 9.474C2.39941 9.474 2.05376 9.37759 1.79518 9.22368C1.53855 9.07092 1.33387 8.84146 1.17225 8.51818C0.836472 7.84655 0.712507 6.82628 0.712507 5.47101C0.712507 3.35035 0.982347 2.28225 1.65335 1.68581C1.99094 1.38572 2.47232 1.1667 3.18628 1.02566C3.90284 0.884101 4.81936 0.827528 5.99646 0.827528Z' stroke-width='0.960719' stroke-linecap='round' stroke-linejoin='round'></path>
                                <path d='M6.47668 4.67017H8.39812' stroke-width='0.960719' stroke-linecap='round' stroke-linejoin='round'></path>
                                <path d='M3.59465 6.5918H8.39825' stroke-width='0.960719' stroke-linecap='round' stroke-linejoin='round'></path>
                            </svg>
                            $cmt
                        </div>
                    </div>
                </a>
            </div>";
                }
            } else {

                $text = __('message.NotFound');
                $Result[] = "<div class='Empty'>
                <img src='/Tools/Images/website_images/empty.png' alt=''>
                <span> $text </span>
            </div>";
            }

            return join("", $Result);
        } else {

            return 'null';
        }
    }

    public function SearchInJobAll(Request $request)
    {


        if ($request->input('searchResult') != null && $request->input('searchResult') != '') {
            $jobs = [];

            $jobs = Job::where("job_name_fa", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("job_name_ar", "LIKE", "%" . $request->input('searchResult') . "%")->where('status', 'تایید شده')->get();

            if ($jobs->count() == 0) {

                $GetCountry = Country::where("country_name_fa", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("country_name_en", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("country_name_ar", "LIKE", "%" . $request->input('searchResult') . "%")->first();

                if ($GetCountry != []) {

                    $jobs = [];

                    $states = $GetCountry->states()->get();
                    foreach ($states as $state) {

                        $citys = $state->cities()->get();
                        foreach ($citys as $city) {

                            $jbs = $city->jobs()->get();
                            foreach ($jbs as $jb) {

                                $jobs[] = $jb;
                            }
                        }
                    }
                } else {

                    $GetState = State::where("state_name_fa", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("state_name_en", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("state_name_ar", "LIKE", "%" . $request->input('searchResult') . "%")->first();

                    if ($GetState != []) {

                        $jobs = [];

                        $citys = $GetState->cities()->get();
                        foreach ($citys as $city) {

                            $jbs = $city->jobs()->get();
                            foreach ($jbs as $jb) {

                                $jobs[] = $jb;
                            }
                        }
                    } else {

                        $GetCity = City::where("city_name_fa", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("city_name_en", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("city_name_ar", "LIKE", "%" . $request->input('searchResult') . "%")->first();

                        if ($GetCity != []) {

                            $jobs = [];

                            $jbs = $GetCity->jobs()->get();
                            foreach ($jbs as $jb) {

                                $jobs[] = $jb;
                            }
                        } else {

                            $GetMain = MainCategory::where("category_name_fa", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("category_name_en", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("category_name_ar", "LIKE", "%" . $request->input('searchResult') . "%")->first();

                            if ($GetMain != []) {

                                $jobs = [];

                                $subs = $GetMain->subcategories()->get();
                                foreach ($subs as $sub) {

                                    $jbs = $sub->jobs()->get();
                                    foreach ($jbs as $jb) {

                                        $jobs[] = $jb;
                                    }
                                }
                            } else {

                                $GetSub = Subcategory::where("subcategory_name_fa", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("subcategory_name_en", "LIKE", "%" . $request->input('searchResult') . "%")->orwhere("subcategory_name_ar", "LIKE", "%" . $request->input('searchResult') . "%")->first();

                                if ($GetSub != []) {

                                    $jobs = [];

                                    $jbs = $GetSub->jobs()->get();
                                    foreach ($jbs as $jb) {

                                        $jobs[] = $jb;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $AllJobsResult = (new Collection($jobs))->paginate(9);
            if ($AllJobsResult->count() == 0) {
                Helper::msg(__('message.NotFound'), 'error');
                $emptyResults = __('message.NotFound');
                $AllJobsResult = "<div class='emptyResults'>$emptyResults</div>";
            }

            return view("website.AllJobs", [
                'Jobs' => $AllJobsResult,
            ]);
        } else {

            $AllJobsResult = Job::where("status", "تایید شده")->paginate(9);
            return view("website.AllJobs", [
                'Jobs' => $AllJobsResult,
            ]);
        }
    }
}
