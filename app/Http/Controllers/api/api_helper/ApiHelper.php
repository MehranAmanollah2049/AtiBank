<?php

namespace App\Http\Controllers\api\api_helper;

use App\Http\Controllers\api\CommentController;
use App\Models\Job;


class ApiHelper
{

    public static function getJbInfos(Job $job)
    {

        $country = $job->city()->first()->state()->first()->country()->first();
        $state = $job->city()->first()->state()->first();
        $city = $job->city()->first();
        $category = $job->subcategory()->first()->category()->first();
        $subcategory = $job->subcategory()->first();

        
        $infosAll = [
            "country_name_fa" => $country->country_name_fa,
            "country_name_en" => $country->country_name_en,
            "country_name_ar" => $country->country_name_ar,

            "state_name_fa" => $state->state_name_fa,
            "state_name_en" => $state->state_name_en,
            "state_name_ar" => $state->state_name_ar,

            "city_name_fa" => $city->city_name_fa,
            "city_name_en" => $city->city_name_en,
            "city_name_ar" => $city->city_name_ar,

            "category_name_fa" => $category->category_name_fa,
            "category_name_en" => $category->category_name_en,
            "category_name_ar" => $category->category_name_ar,

            "subcategory_name_fa" => $subcategory->subcategory_name_fa,
            "subcategory_name_en" => $subcategory->subcategory_name_en,
            "subcategory_name_ar" => $subcategory->subcategory_name_ar,
            
        ];

        return $infosAll;
    }

    public static function getJbInfos2(Job $job,$isAuth)
    {

        $country = $job->city()->first()->state()->first()->country()->first();
        $state = $job->city()->first()->state()->first();
        $city = $job->city()->first();
        $category = $job->subcategory()->first()->category()->first();
        $subcategory = $job->subcategory()->first();

        $Comment = new CommentController();
        $cmtsAll = $Comment->getAll($job,$isAuth);


        $infosAll = [
            "country_name_fa" => $country->country_name_fa,
            "country_name_en" => $country->country_name_en,
            "country_name_ar" => $country->country_name_ar,

            "state_name_fa" => $state->state_name_fa,
            "state_name_en" => $state->state_name_en,
            "state_name_ar" => $state->state_name_ar,

            "city_name_fa" => $city->city_name_fa,
            "city_name_en" => $city->city_name_en,
            "city_name_ar" => $city->city_name_ar,

            "category_name_fa" => $category->category_name_fa,
            "category_name_en" => $category->category_name_en,
            "category_name_ar" => $category->category_name_ar,

            "subcategory_name_fa" => $subcategory->subcategory_name_fa,
            "subcategory_name_en" => $subcategory->subcategory_name_en,
            "subcategory_name_ar" => $subcategory->subcategory_name_ar,
            "comments" => $cmtsAll,
        ];

        return $infosAll;
    }
}
