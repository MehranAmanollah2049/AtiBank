<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Positions\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class CityController extends Controller
{
    // add
    public function add(CityRequest $request)
    {

        $validation = $request->validated();

        if ($this->checkCity($validation)) {

            City::create($validation);
            Helper::msg('شهر مورد  نظر با موفقیت ثبت شد', 'success');
        } else {

            Helper::msg('این شهر از قبل ثبت شده است', 'error');
        }

        return back();
    }

    // delete
    public function delete(City $city)
    {

        foreach ($city->users()->get() as $user) {

            Helper::del_user_infos($user);
            $user->delete();
        }

        $city->delete();

        Helper::msg('شهر مورد نظر با موفقیت ثبت شد', 'success');
        return back();
    }

    // search
    public function search(Request $request)
    {

        $citys = City::all();

        if ($request->input("searchVal") != "") {

            $citys = City::where("city_name_fa", "LIKE", "%" . $request->input('searchVal') . "%")->orwhere("city_name_en", "LIKE", "%" . $request->input('searchVal') . "%")->orwhere("city_name_ar", "LIKE", "%" . $request->input('searchVal') . "%")->get();

            if ($citys->count() == 0) {

                $GetStates = State::where("state_name_fa", "LIKE", "%" . $request->input('searchVal') . "%")->orwhere("state_name_en", "LIKE", "%" . $request->input('searchVal') . "%")->orwhere("state_name_ar", "LIKE", "%" . $request->input('searchVal') . "%")->first();

                if ($GetStates != []) {

                    $citys = $GetStates->cities()->get();
                } else {

                    $GetCountry = Country::where("country_name_fa", "LIKE", "%" . $request->input('searchVal') . "%")->orwhere("country_name_en", "LIKE", "%" . $request->input('searchVal') . "%")->orwhere("country_name_ar", "LIKE", "%" . $request->input('searchVal') . "%")->first();

                    if ($GetCountry != []) {

                        $states = $GetCountry->states()->get();
                        if ($states->count() != 0) {

                            $citys = [];
                            foreach ($states as $state) {

                                $cities = $state->cities()->get();
                                foreach ($cities as $city) {

                                    $citys[] = $city;
                                }
                            }
                        }
                    }
                }
            }
        }

        return view("admin.Positions.city.citys", [
            "sideBar" => "citys",
            "citys" => $citys,
        ]);
    }

    // edit
    public function edit(CityRequest $request, City $city)
    {

        $validation = $request->validated();

        $city->update($validation);
        Helper::msg('اطلاعات شهر مورد نظر با موفقیت ویرایش شد', 'success');

        return back();
    }

    // getCitys
    public function getCitys(State $state)
    {


        $select = __('message.choose');
        $result = "<option selected='selected'>$select</option>";

        if ($state != "" && $state != "@/!") {

            foreach ($state->cities()->get() as $city) {

                $result .= "<option value='$city->id'>$city->city_name_fa</option>";
            }
        }


        return $result;
    }


    // checkCity
    public function checkCity($validation)
    {

        return !!City::where("city_name_fa", $validation['city_name_fa'])->where("state_id", $validation['state_id'])->get();
    }

    // getCitys2
    public function getCitys2(State $state)
    {

        $result = [];
        $title = Lang::get("message.choose");

        if ($state != "" && $state != "@/!") {

            $cities = $state->cities()->get();
            if ($cities->count() != 0) {

                foreach ($cities as $city) {

                    $name = $city->{'city_name_' . session('lang')} != null ? $city->{'city_name_' . session('lang')} : $city->city_name_fa;
                    $id = $city->id;
                    $result[] = "<div class='drps_option' onclick='pickCity($id,event)'>$name</div>";
                }
            } else {

                $empty = __('message.NotFound');
                $result[] = "<div class='empty'> $empty </div>";
            }
        } else {

            $empty = __('message.NotFound');
            $result[] = "<div class='empty'> $empty </div>";
        }


        $result[] = $title;

        echo join("|", $result);
    }

    public function getCity3(State $state)
    {

        if ($state != "" && $state != "@/!") {

            $cities = $state->cities()->get();
            if ($cities->count() != 0) {

                foreach ($cities as $index => $city) {

                    $name = $city->{'city_name_' . session('lang')} != null ? $city->{'city_name_' . session('lang')} : $city->city_name_fa;
                    $id = $city->id;

                    $counter = "city" . $index;

                    echo "<div class='checkBoxCon' onclick='selectCity(event)'>
                        <input type='radio' name='city' id='$counter' value='$id'>
                        <label for='$counter'>
                            <div class='check_box'>
                                <div class='checked'>
                                    <i class='fi fi-br-check'></i>
                                    <div class='loading-spinner-checkbox'></div>
                                </div>
                            </div>
                            <span> $name </span>
                        </label>
                    </div>";
                }
            } else {

                $empty = __('message.NotFound');
                echo "<div class='empty_filter'> $empty </div>";
            }
        } else {

            $empty = __('message.NotFound');
            echo "<div class='empty_filter'> $empty </div>";
        }
    }

 
}
