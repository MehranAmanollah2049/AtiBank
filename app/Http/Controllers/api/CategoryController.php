<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function mainCategory() {

        return response(MainCategory::all()->toArray(),200);
    }

    public function subCategory(MainCategory $mainCategory) {

        return response($mainCategory->subcategories()->get()->toArray(),200);
    }

}
