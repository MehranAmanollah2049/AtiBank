<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\Helper;
use App\Http\Requests\About\EditMainRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    // EditMain
    public function EditMain(EditMainRequest $request, AboutUs $aboutus)
    {

        $validation = $request->validated();

        $aboutus->update($validation);

        Helper::msg("متن اصلی با موفقیت ویرایش شد", 'success');
        return back();
    }

    // addItem
    public function addItem(Request $request)
    {


        if ($request->data_content_type == "عنوان") {

            $validation = $request->validate([
                'content_fa' => 'required',
                'content_en' => 'required',
                'content_ar' => 'required',
            ]);

            AboutUs::create([
                "content_fa" => $validation['content_fa'],
                "content_en" => $validation['content_en'],
                "content_ar" => $validation['content_ar'],
                "data_content_type" => 'عنوان',
            ]);
        } else if ($request->data_content_type == "متن") {

            $validation = $request->validate([
                'content_text_fa' => 'required',
                'content_text_en' => 'required',
                'content_text_ar' => 'required',
            ]);

            AboutUs::create([
                "content_fa" => $validation['content_text_fa'],
                "content_en" => $validation['content_text_en'],
                "content_ar" => $validation['content_text_ar'],
                "data_content_type" => 'متن',
            ]);
        } else if ($request->data_content_type == "عکس") {

            $request->validate([
                'img' => 'required|mimes:jpg,png,webp,jpeg|max:500000',
            ]);

            if ($path = Helper::uploadImg($request->file('img'), '/About_images')) {

                AboutUs::create([
                    "img" => $path,
                    "data_content_type" => 'عکس',
                ]);
            }
        }


        Helper::msg("آیتم مورد نظر با موفقیت ثبت شد", 'success');
        return back();
    }

    // delete item
    public function delete(AboutUs $aboutus)
    {

        $aboutus->delete();
        Helper::msg('آیتم مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // edit
    public function edit(Request $request, AboutUs $aboutus)
    {

        if ($request->data_content_type == "عنوان") {

            $validation = $request->validate([
                'content_fa' => 'required',
                'content_en' => 'required',
                'content_ar' => 'required',
            ]);

            $aboutus->update([
                "content_fa" => $validation['content_fa'],
                "content_en" => $validation['content_en'],
                "content_ar" => $validation['content_ar'],
                "data_content_type" => 'عنوان',
                'img' => '-',
            ]);
        } else if ($request->data_content_type == "متن") {

            $validation = $request->validate([
                'content_text_fa' => 'required',
                'content_text_en' => 'required',
                'content_text_ar' => 'required',
            ]);

            $aboutus->update([
                "content_fa" => $validation['content_text_fa'],
                "content_en" => $validation['content_text_en'],
                "content_ar" => $validation['content_text_ar'],
                "data_content_type" => 'متن',
                'img' => '-',
            ]);
        } else if ($request->data_content_type == "عکس") {

            $request->validate([
                'img' => 'required|mimes:jpg,png,webp,jpeg|max:500000',
            ]);

            if($aboutus->data_content_type == 'عکس') {

                Helper::RemoveImg($aboutus->img);
            }

            if ($path = Helper::uploadImg($request->file('img'), '/About_images')) {

                $aboutus->update([
                    "content_fa" => '-',
                    "content_en" => '-',
                    "content_ar" => '-',
                    "img" => $path,
                    "data_content_type" => 'عکس',
                ]);
            }
        }


        Helper::msg("آیتم مورد نظر با موفقیت ویرایش شد", 'success');
        return back();
    }

    // show text
    public function showText($aboutus)
    {

        return AboutUs::where('id' , $aboutus)->withTrashed()->first()->content_fa;
    }
}
