<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Positions\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // add
    public function add(CountryRequest $request)
    {

        $validation = $request->validated();

        if ($this->checkCountry($validation)) {

            Country::create($validation);

            Helper::msg('کشور مورد نظر با موفقیت ثبت شد', 'success');
        }
        else {

            Helper::msg('این کشور از قبل ثبت شده است', 'error');
        }

        return back();
    }

    // delete
    public function delete(Country $country)
    {

        $country->delete();

        Helper::msg('کشور مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // search
    public function search(Request $request)
    {

        $countrys = Country::all();

        if($request->input("searchVal") != "") {

            $countrys = Country::where("country_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("country_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("country_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->get();
        }

        return view('admin.positions.country.countrys', [
            'sideBar' => 'positions',
            "countrys" => $countrys,
        ]);
    }

    // edit
    public function edit(CountryRequest $request, Country $country)
    {

        $validation = $request->validated();

        $country->update($validation);

        Helper::msg('اطلاعات کشور مورد نظر با موفقیت ویرایش شد', 'success');
        return back();
    }


    // check country
    public function checkCountry($validation) {

        return !! Country::where("country_name_fa", $validation['country_name_fa'])->get();
    }


}
