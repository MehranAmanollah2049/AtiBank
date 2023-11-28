<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Models\Contact;
use App\Models\ContactUsInfos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\TextUI\Help;

class ContactController extends Controller
{
    public function showText($contact)  {

        return Contact::where('id' , $contact)->withTrashed()->first()->text;
    }

    public function delete(Contact $contact) {

        $contact->delete();
        Helper::msg('درخواست مورد نظر با موفقیت  حذف شد','success');
        return back();
    }

    public function manageContact(Request $request) {

        $validation = $request->validate([
            'insta_name' => 'string|nullable',
            'insta_link' => 'string|nullable',
            'email_name' => 'string|nullable',
            'email_link' => 'string|nullable',
            'telegram_name' => 'string|nullable',
            'telegram_link' => 'string|nullable',
            'phones' => 'string|nullable',
            'address_fa' => 'string|nullable',
            'address_en' => 'string|nullable',
            'address_ar' => 'string|nullable',
        ]);


        $check = ContactUsInfos::all();
        if($check->count() == 0) {

            ContactUsInfos::create($validation);
        }
        else {

            $check->first()->update($validation);
        }

        return back();
    }

    public function add(Request $request) {

        // validation
        $validation = Validator::make($request->all(), [
            "name" => ['required' , 'string'],
            "family" => ['required' , 'string'],
            "email" => ['required' , 'string' , 'email'],
            "phoneNumber" => ['required' , 'string'],
            'description' => ['required' , 'string'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            Helper::msg($errors->first(), 'error');
            return back();
        }


        Contact::create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'text' => nl2br($request->description),
        ]);


        Helper::msg(__('message.job_added_success_request') , 'success');
        return back();
    }
}
