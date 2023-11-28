<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    
    public function getList() {


        $countryList = Country::all()->toArray();
        return response($countryList,200);
    }

}
