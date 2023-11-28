<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Category\MainRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class CategroyController extends Controller
{
    // add
    public function add(MainRequest $request) {

        $validation = $request->validated(); 

        if($this->checkMain($validation)) {

           MainCategory::create($validation);

           Helper::msg('دسته مورد نظر با موفقیت ثبت شد','success');

        }
        else {

            Helper::msg('این دسته از قبل ثبت شده','error');
        }

        return back();
    }

    // delete
    public function delete(MainCategory $mainCategory) {

        $mainCategory->delete();
        Helper::msg('دسته مورد نظر با موفقیت حذف شد','success');
        return back();
    }

    // search
    public function search(Request $request) {

        $categories = MainCategory::all();

        if($request->input("searchVal") != "") {

            $categories = MainCategory::where("category_name_fa" , "LIKE" , "%" . $request->input("searchVal") . "%")->orwhere("category_name_en" , "LIKE" , "%" . $request->input("searchVal") . "%")->orwhere("category_name_ar" , "LIKE" , "%" . $request->input("searchVal") . "%")->get();
        }

        return view("admin.Catagorys.main_catagory.main_catagory",[
            "sideBar" => "catagorys",
            "categories" => $categories,
        ]);
    }

    // edit
    public function edit(MainRequest $request , MainCategory $mainCategory) {

        $validation = $request->validated(); 

        $mainCategory->update($validation);

        Helper::msg('دسته مورد نظر با موفقیت ویرایش شد','success');

        return back();
    }


    // check main category
    public function checkMain($validation) {

       return !! MainCategory::where("category_name_fa" , $validation['category_name_fa'])->get();
    }
}
