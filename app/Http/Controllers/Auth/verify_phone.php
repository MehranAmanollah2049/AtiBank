<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Http\Controllers\Notification\Notification;
use App\Http\Controllers\Notification\Providers\SmsProvider;
use App\Jobs\sendSms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;


class verify_phone extends Controller
{


    public function resendCode(SmsProvider $smsProvider, Notification $notification)
    {

        $NewCode = $smsProvider->generateCode();

        if (session()->has('user_signup_infos')) {

            $datas = session('user_signup_infos');
            sendSms::dispatch($datas['phoneNumber'], $NewCode, 136765);
            // $notification->sendSms($datas['phoneNumber'], $NewCode, 136765);
        }
        else if(session()->has('New_phoneNumber')) {

            $datas = session('New_phoneNumber');
            sendSms::dispatch($datas['phoneNumber'], $NewCode, 136765);
            // $notification->sendSms($datas['phoneNumber'], $NewCode, 136765);
        } 
        else {

            $datas = session('user_login_infos');
            sendSms::dispatch($datas['phoneNumber'], $NewCode, 136765);
            // $notification->sendSms($datas['phoneNumber'], $NewCode, 136765);
        }
        
        session(['code' => $NewCode]);

        Helper::msg(Lang::get("message.msgSent"), 'success');
        return back();
    }

    public function verify(Request $request)
    {

        // validation
        $validation = Validator::make($request->all(), [
            'digits1' => ['required', 'numeric'],
            'digits2' => ['required', 'numeric'],
            'digits3' => ['required', 'numeric'],
            'digits4' => ['required', 'numeric'],
            'digits5' => ['required', 'numeric'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }


        $code = $request->digits1 . $request->digits2 . $request->digits3 . $request->digits4 . $request->digits5;

        if ($code == session('code')) {

            if (session()->has("user_signup_infos")) {

                $user = User::create(session('user_signup_infos'));
                Auth::login($user);
            }
            else if(session()->has('New_phoneNumber')) {

                if(auth()->check()) {

                    $user = User::where('id', auth()->user()->id)->first();
                    $user->update([
                        'phoneNumber' => session('New_phoneNumber')['phoneNumber'],
                        'phone_code' => session('New_phoneNumber')['code'],
                    ]);

                    Helper::msg(__('message.profile_edited') , 'success');
                    return redirect('/panel/profile');

                }
                else {

                    return redirect('/');
                }
            } 
            else {

                $datas = session('user_login_infos');
                $user = User::where("phoneNumber", $datas['phoneNumber'])->first();
                Auth::login($user);
            }

            if(session()->has("admin")) {

                session()->forget("admin");
            }

            session()->regenerate();
            Helper::msg(Lang::get('message.welcome_text'), 'success');

            if (session()->has('PER_URL')) {

                $perUrl = session('PER_URL');
                session()->forget('PER_URL');

                return redirect($perUrl);
                
            } else {

                return redirect('/');
            }
        } else {

            Helper::msg(Lang::get("message.codeWrong"), 'error');
            return back();
        }
    }




}
