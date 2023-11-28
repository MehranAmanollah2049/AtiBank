<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Http\Controllers\Notification\Notification;
use App\Http\Controllers\Notification\Providers\SmsProvider;
use App\Jobs\sendSms;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;
    use ThrottlesLogins;

    protected $maxAttempts = 5;
    protected $decayMinutes = 1;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }


    public function prepareSignUp(Request $request, SmsProvider $smsProvider)
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

        if ($this->hasTooManyLoginAttempts($request)) {

            return $this->sendLockoutResponse($request);
        }

        $this->incrementLoginAttempts($request);

        $phoneNumber = Helper::getPhone($request);
        if ($this->checkUniquePhone($phoneNumber)) {
            
            Helper::msg(Lang::get("validation.unique", ['attribute' => Lang::get('validation.attributes.phoneNumber')]), 'error');
            return back();
        }
        
        
        // send sms
        $code = $smsProvider->generateCode();
        // $notification->sendSms($phoneNumber,$code,136765);
        sendSms::dispatch($phoneNumber, $code, 136765);

        // add datas to session
        session()->forget('New_phoneNumber');
        session()->forget('user_login_infos');
        session()->forget('user_signup_infos');
        session(['user_signup_infos' => $this->setUserDatas($request)]);
        session(['code' => $code]);


        // redirect to confrim sms
        Helper::msg(Lang::get("message.msgSent"), 'success');
        return redirect('/auth/confrim_phone');
    }

    private function checkUniquePhone($phoneNumber)
    {

        $checkPhone = User::where("phoneNumber", $phoneNumber)->get();
        if ($checkPhone->count() > 0) {
            return true;
        }
    }

    
    
    private function setUserDatas($request) {

        return [
            'name' => $request->name,
            'family' => $request->family,
            'phone_code' => $request->Number_code,
            'phoneNumber' => Helper::getPhone($request),
            'password' => Crypt::encrypt($request->password),
            'city_id' => $request->city_id,
        ];
    }


    public function username() {

        return "phoneNumber";
    }

   
}
