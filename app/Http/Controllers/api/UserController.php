<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\api_helper\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Http\Controllers\Notification\Providers\SmsProvider;
use App\Jobs\sendSms;
use App\Models\Job;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    
    public function infoUser(User $user) {
        
        $list = $user->toArray();
        
        $list['phoneNumber'] = str_replace($list['phone_code'],'',$list['phoneNumber']);
        $list['country_code'] = str_replace('+','',$list['phone_code']);
        
        $list['city_name_fa'] = $user->city()->first()->city_name_fa;
        $list['city_name_en'] = $user->city()->first()->city_name_en;
        $list['city_name_ar'] = $user->city()->first()->city_name_ar;
        
        $list['state_name_fa'] = $user->city()->first()->state()->first()->state_name_fa;
        $list['state_name_en'] = $user->city()->first()->state()->first()->state_name_en;
        $list['state_name_ar'] = $user->city()->first()->state()->first()->state_name_ar;
        
        $list['country_name_fa'] = $user->city()->first()->state()->first()->country()->first()->country_name_fa;
        $list['country_name_en'] = $user->city()->first()->state()->first()->country()->first()->country_name_en;
        $list['country_name_ar'] = $user->city()->first()->state()->first()->country()->first()->country_name_ar;
    
        return response($list,200);
    }

    public function FavList(User $user)
    {

        $jobs = $user->likes()->get();
        $JobInfos = [];
        foreach ($jobs as $job) {

            $jb =  $job->toArray();
            $infosAll = ApiHelper::getJbInfos($job);
            $JobInfos[] = array_merge($jb, $infosAll);
        }


        return response($JobInfos, 200);
    }

    public function addFavList(User $user, Job $job)
    {

        $check = Like::where('user_id', $user->id)->where('job_id', $job->id)->first();
        if ($check == []) {

            Like::create([
                'user_id' => $user->id,
                'job_id' => $job->id,
            ]);

            return response('success', 200);
        } else {

            return response('error', 302);
        }
    }

    public function deleteFavList(User $user, Job $job)
    {

        Like::where('user_id', $user->id)->where('job_id', $job->id)->delete();
        return response('deleted', 200);
    }

    public function signup(Request $request)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'family' => ['required', 'string', 'max:20'],
            'phoneNumber' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:0'],
            'city_id' => ['required'],
            'Number_code' => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors()->first();
            return response($errors, 302);
        }


        $phoneNumber = Helper::getPhone($request);
        if ($this->checkUniquePhone($phoneNumber)) {

            return response('notUneque', 302);
        }

        if ($request->profile == 'NO_Picture') {
            
            $user = User::create([
                'name' => $request->name,
                'family' => $request->family,
                'phone_code' => $request->Number_code,
                'phoneNumber' => Helper::getPhone($request),
                'password' => Crypt::encrypt($request->password),
                'city_id' => $request->city_id,
                "profile" => "Tools/Images/Website_images/user.svg",
            ]);
        } else {

            // validation
            $validation = Validator::make($request->all(), [
                "profile" => 'required|mimes:png,jpg,jpeg,webp|max:500000'
            ]);

            if ($validation->fails()) {

                $errors = $validation->errors()->first();
                return response($errors, 302);
            }

            if ($path = Helper::uploadImg($request->file('profile'), '/User_images')) {

                $user = User::create([
                    'name' => $request->name,
                    'family' => $request->family,
                    'phone_code' => $request->Number_code,
                    'phoneNumber' => Helper::getPhone($request),
                    'password' => Crypt::encrypt($request->password),
                    'city_id' => $request->city_id,
                    "profile" => $path,
                ]);
            }
        }



        return response($user, 200);
    }

    private function checkUniquePhone($phoneNumber)
    {

        $checkPhone = User::where("phoneNumber", $phoneNumber)->get();
        if ($checkPhone->count() > 0) {
            return true;
        }
    }

    public function verify_phone($phoneNumber, SmsProvider $smsProvider)
    {

        // send sms
        $code = $smsProvider->generateCode();
        // $notification->sendSms($phoneNumber,$code,136765);
        sendSms::dispatch($phoneNumber, $code, 136765);


        return response($code, 200);
    }

    public function login(Request $request)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'phoneNumber' => ['required', 'numeric'],
            'password' => ['required', 'string'],
            'Number_code' => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }


        $phoneNumber = Helper::getPhone($request);
        if ($user = $this->checkUser($phoneNumber, $request->password)) {

            return response($user, 200);
        } else {

            return response('NotFound', 302);
        }
    }

    public function checkUser($phoneNumber, $pas)
    {

        $user = User::where("phoneNumber", $phoneNumber)->first();
        if ($user != []) {

            if (Crypt::decrypt($user->password) == $pas) {

                return $user;
            }
        } else {

            return false;
        }
    }


    public function JobList(User $user)
    {

        $jobs = $user->jobs()->withTrashed()->get();
        $JobInfos = [];
        foreach ($jobs as $job) {

            $jb =  $job->toArray();

            $infosAll = ApiHelper::getJbInfos($job);

            $JobInfos[] = array_merge($jb, $infosAll);
        }


        return response($JobInfos, 200);
    }

    public function editProfile_text(Request $request, User $user)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'max:20'],
            'family' => ['required', 'max:20'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(), 302);
        }

        // update texts
        $user = User::where('id', $user->id)->first();
        $userEdited = $user->update([
            'name' => $request->name,
            'family' => $request->family,
        ]);

        // update profile image
        if($request->profile == 'NO_Picture') {
            if ($user->profile != 'Tools/Images/Website_images/user.svg') {

                unlink($user->profile);
            }
            $userEdited = $user->update([
                'profile' => 'Tools/Images/Website_images/user.svg',
            ]); 
        }
        else  {

            if ($user->profile != 'Tools/Images/Website_images/user.svg') {

                unlink($user->profile);
            }
            
            if($path = Helper::uploadImg($request->file("profile"), '/User_images')) {
                $userEdited = $user->update([
                    'profile' => $path,
                ]); 
            } 
            
        }

        return response($userEdited, 200);
    }

    public function editProfile_phone(Request $request, User $user, SmsProvider $smsProvider)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'phoneNumber' => ['required'],
            'Number_code' => ['required'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(), 302);
        }


        // update phone number
        if ($user->phoneNumber != $request->Number_code . $request->phoneNumber) {

            $phoneNumber = $request->Number_code . $request->phoneNumber;
            $userNew = $user->update([
                "phone_code" => $request->Number_code,
                "phoneNumber" => $request->Number_code . $request->phoneNumber,
            ]);
            
            return response($user,200);
        } else {

            return response('samePhone', 302);
        }
    }

    public function update_phone(Request $request, User $user)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'phoneNumber' => ['required', 'numeric'],
            'Number_code' => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(), 302);
        }


        $userNew = $user->update([
            "phone_code" => $request->Number_code,
            "phoneNumber" => $request->Number_code . $request->phoneNumber,
        ]);


        return response($userNew, 200);
    }

    public function edit_location(Request $request, User $user)
    {

        $userNew = $user->update([
            'city_id' => $request->city_id,
        ]);

        return response($userNew, 200);
    }

    public function changePas($phoneNumber,Request $request) {

        $user = User::where('phoneNumber' , $phoneNumber)->first();
        if($user != []) {

            $user->update([
                "password" => crypt::encrypt($request->password),
            ]);

            return response('ok',200);
        }
        else {

            return response('user exsits',302);
        }
    }
}
