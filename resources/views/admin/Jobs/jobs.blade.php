@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت شغل ها ")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت مشاغل</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/jobs/add" enctype="multipart/form-data">

            <div class="box-body">


                <div class="form-group">
                    <label>انتخاب کشور</label>
                    <select class="form-control select2 selectCountry" style="width: 100%;" name="country_id" value="{{ old('country_id') }}">
                        <option selected="selected" value="">انتخاب کنید</option>
                        @foreach(App\Models\Country::all() as $country)
                        <option value="{{ $country->id }}"> {{ $country->country_name_fa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب استان</label>
                    <select class="form-control select2 selectState" style="width: 100%;" name="state_id" value="{{ old('state_id') }}">
                        <option selected="selected" value="">انتخاب کنید</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب شهر</label>
                    <select class="form-control select2 selectCity" style="width: 100%;" name="city_id" value="{{ old('city_id') }}">
                        <option selected="selected" value="">انتخاب کنید</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب دسته اصلی</label>
                    <select class="form-control select2 selectMainCategory" style="width: 100%;" name="category_id" value="{{ old('category_id') }}">
                        <option selected="selected" value="">انتخاب کنید</option>
                        @foreach(App\Models\MainCategory::all() as $catagory)
                        <option value="{{ $catagory->id }}"> {{ $catagory->category_name_fa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب دسته فرعی</label>
                    <select class="form-control select2 selectSubCategory" style="width: 100%;" name="subcategory_id" value="{{ old('subcategory_id') }}">
                        <option selected="selected" value="">انتخاب کنید</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان شغل به فارسی</label>
                    <input type="text" name="job_name_fa" class="form-control" id="exampleInputEmail1" placeholder="عنوان شغل   مورد نظر خود را بنویسید" value="{{ old('job_name_fa') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان شغل به انگلیسی</label>
                    <input type="text" name="job_name_en" class="form-control" id="exampleInputEmail1" placeholder="عنوان شغل   مورد نظر خود را بنویسید" value="{{ old('job_name_en') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان شغل به عربی</label>
                    <input type="text" name="job_name_ar" class="form-control" id="exampleInputEmail1" placeholder="عنوان شغل   مورد نظر خود را بنویسید" value="{{ old('job_name_ar') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به فارسی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_fa" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه">{{ old('description_fa') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به انگلیسی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_en" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه">{{ old('description_en') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به عربی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_ar" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه">{{ old('description_ar') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام مدیریت به فارسی</label>
                    <input type="text" name="manager_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام صاحب شغل" value="{{ old('manager_name_fa') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام مدیریت به انگلیسی</label>
                    <input type="text" name="manager_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام صاحب شغل" value="{{ old('manager_name_en') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام مدیریت به عربی</label>
                    <input type="text" name="manager_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام صاحب شغل" value="{{ old('manager_name_ar') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">شماره تماس</label>
                    <input type="text" name="phoneNumber" class="form-control" id="exampleInputEmail1" placeholder="شماره تماس" value="{{ old('phoneNumber') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس به فارسی </label>
                    <input type="text" name="address_fa" class="form-control" id="exampleInputEmail1" placeholder="آدرس" value="{{ old('address_fa') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس به انگلیسی </label>
                    <input type="text" name="address_en" class="form-control" id="exampleInputEmail1" placeholder="آدرس" value="{{ old('address_en') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس به عربی </label>
                    <input type="text" name="address_ar" class="form-control" id="exampleInputEmail1" placeholder="آدرس" value="{{ old('address_ar') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">طول جغرافیایی </label>
                    <input type="text" name="longitude" class="form-control" id="exampleInputEmail1" placeholder="طول جغرافیایی " value="{{ old('longitude') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عرض جغرافیایی </label>
                    <input type="text" name="latitude" class="form-control" id="exampleInputEmail1" placeholder="عرض جغرافیایی " value="{{ old('latitude') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری شنبه</label>
                    <input type="text" name="saturday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('saturday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری یکشنبه</label>
                    <input type="text" name="sunday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('sunday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری دوشنبه</label>
                    <input type="text" name="monday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('monday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری سه شنبه</label>
                    <input type="text" name="tusday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('tusday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری چهارشنبه</label>
                    <input type="text" name="wednesday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('wednesday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری پنج شنبه</label>
                    <input type="text" name="thursday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('thursday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">ساعات کاری جمعه</label>
                    <input type="text" name="friday_time_work" class="form-control" id="exampleInputEmail1" placeholder="ساعت کاری" value="{{ old('friday_time_work') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> اینستاگرام ( اختیاری ) </label>
                    <input type="text" name="instagram" class="form-control" id="exampleInputEmail1" placeholder="اینستاگرام" value="{{ old('instagram') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدی تلگرام ( اختیاری ) </label>
                    <input type="text" name="telegram" class="form-control" id="exampleInputEmail1" placeholder="آدی تلگرام" value="{{ old('telegram') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> ایمیل ( اختیاری ) </label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="آدرس ایمیل" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"> آدرس وب سایت ( اختیاری )</label>
                    <input type="text" name="website_url" class="form-control" id="exampleInputEmail1" placeholder="آدرس وب سایت" value="{{ old('website_url') }}">
                </div>
                <div class="form-group">
                    <label for="formFile">عکس</label>
                    <input class="form-control" type="file" id="formFile" name="banner">
                </div>
            </div>
            @csrf
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())
                {{ $errors->first() }}
                @endif
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ثبت شغل</button>
            </div>
        </form>
    </div>
</div>


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست مشاغل </h3>

                    <div class="box-tools">
                        <form action="/admin/searchJob" method="get">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="searchVal" class="form-control pull-right" placeholder="جستجو">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        @if(count($jobs) != 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>استان</th>
                                    <th>شهر</th>
                                    <th>عنوان دسته اصلی</th>
                                    <th>عنوان دسته فرعی</th>
                                    <th>عنوان شغل</th>
                                    <th>شماره تلفن</th>
                                    <th>تاریخ ثبت</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <a href="/admin/searchState?searchVal={{ $job->city()->first()->state()->first()->state_name_fa }}">
                                            {{ $job->city()->first()->state()->first()->state_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchCity?searchVal={{ $job->city()->first()->city_name_fa }}">
                                            {{ $job->city()->first()->city_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchMainCategory?searchVal={{ $job->subcategory()->first()->category()->first()->category_name_fa }}">
                                            {{ $job->subcategory()->first()->category()->first()->category_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchSubcategory?searchVal={{ $job->subcategory()->first()->subcategory_name_fa }}">
                                            {{ $job->subcategory()->first()->subcategory_name_fa }}
                                        </a>
                                    </td>
                                    <td> {{ $job->job_name_fa }} </td>
                                    <td  style="direction: ltr;">
                                        <a href="/admin/users/{{ $job->phoneNumber }}/info" style="direction: ltr;"> {{ $job->phoneNumber }} </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($job->created_at) }} </td>
                                    <td>{{ $job->status }} </td>
                                    <td>
                                        <form style="display: inline;" action="/admin/job/{{ $job->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        @if($job->status == "تایید نشده")
                                        <form style="display: inline;" action="/admin/job/{{ $job->id }}/accept" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-info">تایید کردن</button>
                                        </form>
                                        @else
                                        <div class="btn btn-info">
                                            <a href="/admin/job/{{ $job->id }}/edit_job">ویرایش</a>
                                        </div>
                                        <div class="btn btn-success">
                                            <a href="/admin/job/{{ $job->id }}/add_pic">عکس ها</a>
                                        </div>
                                        <div class="btn btn-warning">
                                            <a href="/Job/{{ $job->id }}">مشاهده</a>
                                        </div>
                                        @endif

                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="Empty">
                            <img src="/Tools/Images/website_images/empty.png" alt="">
                            <span> موردی یافت نشد </span>
                        </div>
                        @endif

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>



@endsection


@section("js_links")

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/admin/bower_components/select2/dist/js/script.js"></script>
<script defer src="/admin/dist/js/jobs/validation.js"></script>
<script defer src="/admin/dist/js/jobs/SelectGet.js"></script>
<script defer src="/admin/dist/js/jobs/GetInfosloading.js"></script>

@endsection