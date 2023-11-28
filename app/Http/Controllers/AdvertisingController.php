<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\DateHelper;
use App\Http\Controllers\helper\Helper;
use App\Http\Requests\Ads\AdvertisingAddRequest;
use App\Http\Requests\Ads\AdvertisingEditRequest;
use App\Http\Requests\Ads\AdvertisingPriceRequest;
use App\Models\Admin;
use App\Models\Advertising;
use App\Models\MainCategory;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    // addAds
    public function addAds(AdvertisingAddRequest $request)
    {

        $validation = $request->validated();

        $expired_at_dt = DateHelper::getExpriredDate($validation['expired_at']);

        // add ads
        if ($path = Helper::uploadImg($request->file("banner"),'/Ads_images')) {

            Advertising::create([
                "user_id" => session()->has("admin") ? session("admin") : auth()->user()->id,
                'title_fa' => $validation['title_fa'],
                'title_en' => $validation['title_en'],
                'title_ar' => $validation['title_ar'],
                "banner" => $path,
                "link" => $validation['link'],
                'category_id' => $validation['category_id'],
                "status" => session()->has("admin") ? "تایید شده" : "تایید نشده",
                "payment_status" => session()->has("admin") ? "پرداخت شده" : "پرداخت نشده",
                "created_at" => session()->has("admin") ? now() : null,
                "expired_at" => session()->has("admin") ? $expired_at_dt : null,
                "uploader_type" => session()->has("admin") ? "admin" : "user",
                'date_end_days' => $validation['expired_at'],
            ]);

            Helper::msg('تبلیغ مورد نظر با موفقیت ثبت شد', 'success');
        }

        return back();
    }

    // delete
    public function delete(Advertising $advertising, $reason)
    {

        Helper::removeImg($advertising->banner);

        $advertising->delete();
        Helper::msg('تبلیغ مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // delete without sending msg
    public function delete2(Advertising $advertising)
    {

        Helper::removeImg($advertising->banner);

        $advertising->delete();
        Helper::msg('تبلیغ مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // accept
    public function accept(Advertising $advertising)
    {

        $advertising->update([
            "status" => "تایید شده",
        ]);

        Helper::msg('تبلیغ مورد نظر با موفقیت تایید شد', 'success');
        return back();
    }

    // showText
    public function showText($advertising)
    {

        $title = Advertising::where('id' , $advertising)->withTrashed()->first()->title_fa;
        return "<p>$title</p>";
    }

    // EditAds
    public function EditAds(AdvertisingEditRequest $request, Advertising $advertising)
    {


        $validation = $request->validated();


        // update texts
        $advertising->update([
            'title_fa' => $validation['title_fa'],
            'title_en' => $validation['title_en'],
            'title_ar' => $validation['title_ar'],
            "expired_at" => DateHelper::getExpriredDate($validation['expired_at']),
            "link" => $validation['link'],
            'category_id' => $validation['category_id'],
            "payment_status" => $validation['payment_status'] == 'true' ? "پرداخت شده" : "پرداخت نشده",
            'date_end_days'  => $validation['expired_at'],
        ]);


        // update img when img it have been sent
        if ($request->file("banner") != "") {

            $validation = $request->validate([
                'banner' => 'required|mimes:jpg,png,webp,jpeg|max:500000',
            ]);

            Helper::removeImg($advertising->banner);

            if ($path = Helper::uploadImg($request->file("banner"),'/Ads_images')) {

                $advertising->update([
                    "banner" => $path,
                ]);
            }
        }



        Helper::msg('تبلیغ مورد نظر با موفقیت ویرایش شد', 'success');
        return back();
    }

    // searchAds
    public function search(Request $request)
    {

        $ads = Advertising::all();

        if ($request->searchVal != "") {

            if (DateTime::createFromFormat('Y-m-d', $request->searchVal) !== false) {

                $ads = [];
                $adss = Advertising::all();
                foreach ($adss as $ad) {

                    if (DateHelper::FaConvert($ad->created_at) == $request->searchVal || DateHelper::FaConvert($ad->expired_at) == $request->searchVal) {

                        $ads[] = $ad;
                    }
                }
            } else {

                $ads = Advertising::where("status", "LIKE", "%" . $request->searchVal . "%")->orwhere("payment_status", "LIKE", "%" . $request->searchVal . "%")->orwhere("price", $request->searchVal)->get();
                if ($ads->count() == 0) {

                    $user = User::where("name", "LIKE", "%" . $request->searchVal . "%")->orwhere("family", "LIKE", "%" . $request->searchVal . "%")->orwhere("phoneNumber", "LIKE", "%" . $request->searchVal . "%")->first();
                    if ($user != []) {

                        $ads = [];
                        $adsAll = $user->advertising()->get();
                        foreach ($adsAll as $ad) {

                            $ads[] = $ad;
                        }
                    } else {

                        $admin = Admin::where("name", "LIKE", "%" . $request->searchVal . "%")->orwhere("family", "LIKE", "%" . $request->searchVal . "%")->orwhere("phoneNumber", "LIKE", "%" . $request->searchVal . "%")->first();
                        if ($admin != []) {

                            $ads = Advertising::where("uploader_type", "admin")->where("user_id", $admin->id)->get();
                        } else {

                            $place = MainCategory::where("category_name_fa", "LIKE", "%" . $request->searchVal . "%")->first();
                            if ($place != []) {

                                $ads = $place->Getadversting()->get();
                            }
                        }
                    }
                }
            }
        }

        return view("admin.ads.ads", [
            "sideBar" => "ads",
            "ads" => $ads,
        ]);
    }

    // add price
    public function AddPrice(Advertising $advertising, AdvertisingPriceRequest $request)
    {

        $validation = $request->validated();

        $advertising->update($validation);

        Helper::msg('مبلغ  مورد نظر با موفقیت ثبت شد', 'success');
        return back();
    }


}
