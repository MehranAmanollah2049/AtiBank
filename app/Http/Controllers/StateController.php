<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Positions\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class StateController extends Controller
{
    // add
    public function add(StateRequest $request)
    {

        $validation = $request->validated();

        if ($this->checkState($validation)) {

            State::create($validation);

            Helper::msg("استان مورد نظر  با موفقیت ثبت شد", 'success');
        } else {

            Helper::msg("این استان از قبل برای این کشور ثبت شده است", 'error');
        }


        return back();
    }

    // delete
    public function delete(State $state)
    {

        $state->delete();
        Helper::msg("استان مورد نظر با موفقیت حذف شد", 'success');
        return back();
    }

    public function search(Request  $request)
    {

        $states = State::all();

        if ($request->input("searchVal") != "") {

            $states = State::where("state_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("state_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("state_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->get();

            if ($states->count() == 0) {

                $getCountry = Country::where("country_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("country_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("country_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                if ($getCountry != []) {

                    $states = $getCountry->states()->get();
                }
            }
        }

        return view("admin.Positions.state.states", [
            "sideBar" => "states",
            "states" => $states,
        ]);
    }

    public function edit(StateRequest $request, State $state)
    {

        $validation = $request->validated();

        $state->update($validation);

        Helper::msg("اطلاعات مورد نظر با موفقیت ویرایش شد ", 'success');
        return back();
    }

    public function getStates(Country $country)
    {

        $select = __('message.choose');
        $result = "<option selected='selected'>$select</option>";

        if ($country != "" && $country != "@/!") {

            foreach ($country->states()->get() as $state) {

                $result .= "<option value='$state->id'>$state->state_name_fa</option>";
            }
        }


        return join("|", [$result, "<option selected='selected'>$select</option>"]);
    }

    // getStates
    public function getStates2(Country $country)
    {

        $empty2 = __('message.choose_state');
        $cityEmpty = "<div class='empty'>
                            $empty2
                        </div>";

        if ($country != "" && $country != "@/!") {

            $states = $country->states()->get();
            if ($states->count() != 0) {

                $results = [];
                foreach ($states as $state) {

                    $name = $state->{'state_name_' . session('lang')} != null ? $state->{'state_name_' . session('lang')} : $state->state_name_fa;
                    $id = $state->id;
                    $results []="<div class='drps_option' onclick='getCitys($id,event)'>$name</div>";
                }

                echo join("|", [join("",$results), $cityEmpty, __('message.choose')]);

            } else {

                App::setLocale(session('lang'));
                $empty = __('message.NotFound');
                echo join("|", ["<div class='empty'> $empty </div>", $cityEmpty, __('message.choose')]);
            }
        } else {

            App::setLocale(session('lang'));
            $empty = __('message.NotFound');
            echo join("|", ["<div class='empty'> $empty </div>", $cityEmpty, __('message.choose')]);
        }
    }

    // check state
    public function checkState($validation)
    {

        return !!State::where("state_name_fa", $validation['state_name_fa'])->where('country_id', $validation['country_id'])->get();
    }


    public function getStates3(Country $country)
    {

        if ($country != "" && $country != "@/!") {

            $states = $country->states()->get();
            if ($states->count() != 0) {

                foreach ($states as $index => $state) {

                    $name = $state->{'state_name_' . session('lang')} != null ? $state->{'state_name_' . session('lang')} : $state->state_name_fa;
                    $id = $state->id;

                    $counter = "state" . $index;

                    echo "<div class='checkBoxCon' onclick='getCity(event,$id)'>
                        <input type='radio' name='state' id='$counter' value='$id'>
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
