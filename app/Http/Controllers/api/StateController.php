<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    
    public function getList(Country $country) {


        $stateList = $country->states()->get()->toArray();
        return response($stateList,200);
    }

}
