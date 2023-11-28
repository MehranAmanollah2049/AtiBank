<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ContactUsInfos;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function getAll() {

        return response(ContactUsInfos::all()->toArray(),200);
    }
    
    public function addContact(Request $request) {
        // validation
        $validation = Validator::make($request->all(), [
            "name" => ['required'],
            "family" => ['required'],
            "email" => ['required' , 'email'],
            "phoneNumber" => ['required'],
            "description" => ['required'],
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(),302);
        }


        Contact::create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'text' => nl2br($request->description),
        ]);


        return response('added',200);
    }
}
