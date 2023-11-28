<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    
    public function getList(State $state) {

        $cityList = $state->cities()->get()->toArray();
        return response($cityList,200);
    }

}
