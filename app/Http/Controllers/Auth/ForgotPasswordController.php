<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Http\Controllers\Notification\Notification;
use App\Http\Controllers\Notification\Providers\SmsProvider;
use App\Jobs\sendSms;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;
    use ThrottlesLogins;

    protected $maxAttempts = 5;
    protected $decayMinutes = 1;


    public function prepareLogIn_forgetpas(Request $request, SmsProvider $smsProvider, Notification $notification)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'phoneNumber' => ['required', 'numeric'],
            'Number_code' => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }

        if ($this->hasTooManyLoginAttempts($request)) {

            return $this->sendLockoutResponse($request);
        }


        // check phone number
        $phoneNumber = Helper::getPhone($request);
        if ($this->checkUser($phoneNumber)) {
            
            // send sms
            $code = $smsProvider->generateCode();
            // $notification->sendSms($phoneNumber, $code, 136765);
            sendSms::dispatch($phoneNumber, $code, 136765);

            // add datas to session
            session()->forget('user_signup_infos');
            session(['user_login_infos' => $this->setUserDatas($request)]);
            session(['code' => $code]);

            // redirect to confrim sms
            Helper::msg(Lang::get("message.msgSent"), 'success');
            return redirect('/auth/confrim_phone');
        }


        $this->incrementLoginAttempts($request);
        Helper::msg(Lang::get("validation.userNotFound"), 'error');
        return back();
    }

    public function checkUser($phoneNumber)
    {

        return !!User::where("phoneNumber", $phoneNumber)->first();
    }


    private function setUserDatas($request)
    {

        return [
            'phone_code' => $request->Number_code,
            'phoneNumber' => Helper::getPhone($request),
        ];
    }

    public function username()
    {

        return "phoneNumber";
    }
}
