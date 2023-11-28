<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\DateHelper;
use App\Http\Controllers\helper\Helper;
use App\Http\Controllers\Notification\Providers\SmsProvider;
use App\Jobs\sendSms;
use App\Models\Job;
use App\Models\Like;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    // delete
    public function delete(User $user, $JobDelStatus)
    {

        Helper::del_user_infos($user);

        if ($JobDelStatus == "yes") {

            Helper::del_user_jobs($user);
            Helper::msg('کاربر مورد نظر همراه با شغل های مربوطه با موفقیت حذف شد', 'success');
        }

        Helper::removeImg($user->profile);

        $user->delete();
        Helper::msg('کاربر مورد نظر با موفقیت حذف شد', 'success');

        return back();
    }

    // search
    public function search(Request $request)
    {

        $users = User::all();

        if ($request->input("searchVal") != "") {

            if (DateTime::createFromFormat('Y-m-d', $request->input("searchVal")) !== false) {

                $users = [];
                $usrs = User::all();
                foreach ($usrs as $user) {

                    if (DateHelper::FaConvert($user->created_at) == $request->input("searchVal")) {

                        $users[] = $user;
                    }
                }
            } else {

                $users = User::where("name", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("family", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("phoneNumber", "LIKE", "%" . $request->input("searchVal") . "%")->get();
            }
        }

        return view("admin.Users.users", [
            "sideBar" => "users",
            "users" => $users,
        ]);
    }

    // like job
    public function like_job(Job $job)
    {



        if (auth()->check()) {

            if (Like::checkLike($job->id)) {

                Like::unlike($job->id);

                $likeAll = $job->likes()->get()->count();
                $user_fav_num = User::where('id' , auth()->user()->id)->first()->likes()->get()->count();
                return join('|', [$likeAll, 'unliked', __('responses.unlikedSuccess'),$user_fav_num]);
            } else {

                Like::like($job->id);

                $likeAll = $job->likes()->get()->count();
                $user_fav_num = User::where('id' , auth()->user()->id)->first()->likes()->get()->count();
                return join("|", [$likeAll, 'liked', __('responses.likedSuccess'),$user_fav_num]);
            }
        } else {

            return join('|', [__('responses.you_have_to_signup')]);
        }
    }

    public function deleteFavList(Job $job)
    {

        Like::where("job_id", $job->id)->where("user_id", auth()->user()->id)->delete();
        Helper::msg(__("message.Listjob"), 'success');
        return back();
    }

    public function editProfile(Request $request, SmsProvider $smsProvider)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'family' => ['required', 'string', 'max:20'],
            'phoneNumber' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8'],
            'city_id' => ['required'],
            'Number_code' => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        // update texts
        $user = User::where('id', auth()->user()->id)->first();
        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'password' => Crypt::encrypt($request->password),
            'city_id' => $request->city_id,
        ]);

        // update profile image
        if ($request->file('profile') != null) {

            if ($user->profile != 'Tools/Images/Website_images/user.svg') {

                unlink($user->profile);
            }

            if ($path = Helper::uploadImg($request->file("profile"), '/User_images')) {

                $user->update([
                    'profile' => $path,
                ]);
            }
            
        }
        else if ($request->profile_status != '') {

            if ($user->profile != 'Tools/Images/Website_images/user.svg') {

                unlink($user->profile);
            }

            $user->update([
                'profile' => 'Tools/Images/Website_images/user.svg',
            ]);
        }

        // update phone number
        if ($user->phoneNumber != $request->Number_code . $request->phoneNumber) {

            $phoneNumber = $request->Number_code . $request->phoneNumber;
            $code = $smsProvider->generateCode();
            // $notification->sendSms($phoneNumber,$code,136765);
            sendSms::dispatch($phoneNumber, $code, 136765);

            session()->forget('user_signup_infos');
            session()->forget('New_phoneNumber');
            session()->forget('user_login_infos');
            session(['New_phoneNumber' => ['code' => $request->Number_code , 'phoneNumber' => $phoneNumber]]);
            session(['code' => $code]);

            Helper::msg(Lang::get("message.msgSent"), 'success');
            return redirect()->route('panel.confrim_phone');
        }


        Helper::msg(__('message.profile_edited') , 'success');
        return back();
    }
}
