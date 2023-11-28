<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Category\SubRequest;
use App\Models\MainCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubcategoryController extends Controller
{
    // add
    public function add(SubRequest $request)
    {

        $validation = $request->validated();


        if ($this->checkSub($validation)) {

            Subcategory::create($validation);

            Helper::msg('دسته فرعی با موفقیت ثبت شد', 'success');
        } else {

            Helper::msg('این دسته از قبل ثبت شده است', 'error');
        }


        return back();
    }

    // delete
    public function delete(Subcategory $subcategory)
    {

        $subcategory->delete();
        Helper::msg('دسته فرعی مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // search
    public function search(Request $request)
    {

        $subcategories = Subcategory::all();

        if ($request->input("searchVal") != "") {

            $subcategories = Subcategory::where("subcategory_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("subcategory_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("subcategory_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->get();

            if ($subcategories->count() == 0) {

                $GetMainCat = MainCategory::where("category_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("category_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("category_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();

                if ($GetMainCat != []) {

                    $subcategories = $GetMainCat->subcategories()->get();
                }
            }
        }

        return view("admin.Catagorys.subcategory.subcategory", [
            "sideBar" => "catagorys",
            "subcategories" => $subcategories,
        ]);
    }

    // edit
    public function edit(SubRequest $request, Subcategory $subcategory)
    {

        $validation = $request->validated();

        $subcategory->update($validation);
        Helper::msg('دسته فرعی مورد نظر با موفقیت ویرایش شد', 'success');

        return back();
    }

    // getSubcategorys
    public function getSubcategorys(MainCategory $maincategory)
    {

        $select = __('message.choose');
        $result = "<option selected='selected'>$select</option>";

        if ($maincategory != "" && $maincategory != "@/!") {

            foreach ($maincategory->subcategories()->get() as $subcategory) {

                $result .= "<option value='$subcategory->id'>$subcategory->subcategory_name_fa</option>";
            }
        }


        return $result;
    }

    // check subcategory
    public function checkSub($validation)
    {

        return !!Subcategory::where("subcategory_name_fa", $validation['subcategory_name_fa'])->where("category_id", $validation['category_id'])->get();
    }

    public function getSubs(MainCategory $maincategory)
    {

        if ($maincategory != "" && $maincategory != "@/!") {

            $subcategories = $maincategory->subcategories()->get();
            if ($subcategories->count() != 0) {

                foreach ($subcategories as $index => $subcategory) {

                    $name = $subcategory->{'subcategory_name_' . session('lang')} != null ? $subcategory->{'subcategory_name_' . session('lang')} : $subcategory->subcategory_name_fa;
                    $id = $subcategory->id;

                    $counter = "subcategory" . $index;

                    echo "<div class='checkBoxCon' onclick='selectsubcategory(event)'>
                        <input type='radio' name='subcategory' id='$counter' value='$id'>
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
