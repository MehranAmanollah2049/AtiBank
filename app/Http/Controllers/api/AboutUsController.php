<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function getAll() {

        return response(AboutUs::where('type' , 'article')->get()->toArray(),200);
    }
}
