@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت شغل ها ")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش مشاغل</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/job/{{ $job->id }}/edit" enctype="multipart/form-data">

            <div class="box-body">

                <div class="form-group">
                    <label>انتخاب کشور</label>
                    <select class="form-control select2 selectCountry" style="width: 100%;" name="country_id">
                        <option value="">انتخاب کنید</option>
                        @foreach(App\Models\Country::all() as $country)
                        @if($job->city()->first()->state()->first()->country()->first()->id == $country->id)
                        <option value="{{ $country->id }}" selected> {{ $country->country_name_fa }} </option>
                        @else
                        <option value="{{ $country->id }}"> {{ $country->country_name_fa }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب استان</label>
                    <select class="form-control select2 selectState" style="width: 100%;" name="state_id">
                        <option value="">انتخاب کنید</option>
                        @foreach($job->city()->first()->state()->first()->country()->first()->states()->get() as $state)
                        @if($job->city()->first()->state()->first()->id == $state->id)
                        <option value="{{ $state->id }}" selected> {{ $state->state_name_fa }} </option>
                        @else
                        <option value="{{ $state->id }}"> {{ $state->state_name_fa }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب شهر</label>
                    <select class="form-control select2 selectCity" style="width: 100%;" name="city_id">
                        <option value="">انتخاب کنید</option>
                        @foreach($job->city()->first()->state()->first()->cities()->get() as $city)
                        @if($job->city_id == $city->id)
                        <option value="{{ $city->id }}" selected> {{ $city->city_name_fa }} </option>
                        @else
                        <option value="{{ $city->id }}"> {{ $city->city_name_fa }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب دسته اصلی</label>
                    <select class="form-control select2 selectMainCategory" style="width: 100%;" name="category_id">
                        <option selected="selected" value="">انتخاب کنید</option>
                        @foreach(App\Models\MainCategory::all() as $catagory)
                        @if($job->subcategory()->first()->category()->first()->id == $catagory->id)
                        <option value="{{ $catagory->id }}" selected> {{ $catagory->category_name_fa }} </option>
                        @else
                        <option value="{{ $catagory->id }}"> {{ $catagory->category_name_fa }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب دسته فرعی</label>
                    <select class="form-control select2 selectSubCategory" style="width: 100%;" name="subcategory_id">
                        <option selected="selected" value="">انتخاب کنید</option>
                        @foreach($job->subcategory()->first()->category()->first()->subcategories()->get() as $subcatagory)
                        @if($job->subcategory_id == $subcatagory->id)
                        <option value="{{ $subcatagory->id }}" selected> {{ $subcatagory->subcategory_name_fa }} </option>
                        @else
                        <option value="{{ $subcatagory->id }}"> {{ $subcatagory->subcategory_name_fa }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان شغل به فارسی</label>
                    <input type="text" name="job_name_fa" class="form-control" id="exampleInputEmail1" placeholder="عنوان شغل   مورد نظر خود را بنویسید" value="{{ $job->job_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان شغل به انگلیسی</label>
                    <input type="text" name="job_name_en" class="form-control" id="exampleInputEmail1" placeholder="عنوان شغل   مورد نظر خود را بنویسید" value="{{ $job->job_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان شغل به عربی</label>
                    <input type="text" name="job_name_ar" class="form-control" id="exampleInputEmail1" placeholder="عنوان شغل   مورد نظر خود را بنویسید" value="{{ $job->job_name_ar }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به فارسی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_fa" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه"> {{ $job->description_fa }} </textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به انگلیسی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_en" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه"> {{ $job->description_en }} </textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به عربی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_ar" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه"> {{ $job->description_ar }} </textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام مدیریت به فارسی</label>
                    <input type="text" name="manager_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام صاحب شغل" value="{{ $job->manager_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام مدیریت به انگلیسی</label>
                    <input type="text" name="manager_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام صاحب شغل" value="{{ $job->manager_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام مدیریت به عربی</label>
                    <input type="text" name="manager_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام صاحب شغل" value="{{ $job->manager_name_ar }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">شماره تماس</label>
                    <input type="text" name="phoneNumber" class="form-control" id="exampleInputEmail1" placeholder="شماره تماس" value="{{ $job->phoneNumber }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس به فارسی </label>
                    <input type="text" name="address_fa" class="form-control" id="exampleInputEmail1" placeholder="آدرس" value="{{ $job->address_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس به انگلیسی </label>
                    <input type="text" name="address_en" class="form-control" id="exampleInputEmail1" placeholder="آدرس" value="{{ $job->address_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس به عربی </label>
                    <input type="text" name="address_ar" class="form-control" id="exampleInputEmail1" placeholder="آدرس" value="{{ $job->address_ar }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">طول جغرافیایی </label>
                    <input type="text" name="longitude" class="form-control" id="exampleInputEmail1" placeholder="طول جغرافیایی " value="{{ $job->longitude }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عرض جغرافیایی </label>
                    <input type="text" name="latitude" class="form-control" id="exampleInputEmail1" placeholder="عرض جغرافیایی " value="{{ $job->latitude }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری شنبه</label>
                    <input type="text" name="saturday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->saturday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری یکشنبه</label>
                    <input type="text" name="sunday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->sunday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری دوشنبه</label>
                    <input type="text" name="monday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->monday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری سه شنبه</label>
                    <input type="text" name="tusday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->tusday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری چهارشنبه</label>
                    <input type="text" name="wednesday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->wednesday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری پنج شنبه</label>
                    <input type="text" name="thursday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->thursday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری جمعه</label>
                    <input type="text" name="friday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ $job->friday_time_work }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> اینستاگرام ( اختیاری ) </label>
                    <input type="text" name="instagram" class="form-control" id="exampleInputEmail1" placeholder="اینستاگرام" value="{{ $job->instagram }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدی تلگرام ( اختیاری ) </label>
                    <input type="text" name="telegram" class="form-control" id="exampleInputEmail1" placeholder="آدی تلگرام" value="{{ $job->telegram }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> ایمیل ( اختیاری ) </label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="آدرس ایمیل" value="{{ $job->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس وب سایت ( اختیاری )</label>
                    <input type="text" name="website_url" class="form-control" id="exampleInputEmail1" placeholder="آدرس وب سایت" value="{{ $job->website_url }}">
                </div>
                <div class="form-group">
                    <label for="formFile">عکس</label>
                    <input class="form-control" type="file" id="formFile" name="banner">
                </div>
            </div>
            @csrf
            @method("put")
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())

                {{ $errors->first() }}

                @endif
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ویرایش اطلاعات</button>
            </div>
        </form>
    </div>
</div>



@endsection


@section("js_links")

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/admin/bower_components/select2/dist/js/script.js"></script>
<script defer src="/admin/dist/js/jobs/validation3.js"></script>
<script defer src="/admin/dist/js/jobs/SelectGet.js"></script>

@endsection