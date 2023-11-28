<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Http\Controllers\Notification\Notification;
use App\Http\Controllers\Notification\Providers\SmsProvider;
use App\Jobs\sendSms;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;
    use ThrottlesLogins;

    protected $maxAttempts = 5;
    protected $decayMinutes = 1;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function prepareLogIn(Request $request, SmsProvider $smsProvider, Notification $notification)
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

        if ($this->hasTooManyLoginAttempts($request)) {

            return $this->sendLockoutResponse($request);
        }



        // check phone number
        $phoneNumber = Helper::getPhone($request);
        if ($this->checkUser($phoneNumber, $request->password)) {
            
            // send sms
            $code = $smsProvider->generateCode();
            // $notification->sendSms($phoneNumber, $code, 136765);
            sendSms::dispatch($phoneNumber, $code, 136765);



            // add datas to session
            session()->forget('New_phoneNumber');
            session()->forget('user_login_infos');
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


    public function checkUser($phoneNumber, $pas)
    {

        $user = User::where("phoneNumber", $phoneNumber)->first();
        if ($user != []) {

            return Crypt::decrypt($user->password) == $pas;
        } else {

            return false;
        }
    }


    private function setUserDatas($request)
    {

        return [
            'phone_code' => $request->Number_code,
            'phoneNumber' => Helper::getPhone($request),
            'password' => $request->password,
        ];
    }


    public function username()
    {

        return "phoneNumber";
    }
}
