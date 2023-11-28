@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت تبلیغات ها ")

@section("css_links")

<link rel="stylesheet" href="/Tools/Css/jquery.Bootstrap-PersianDateTimePicker.css">

@endsection

@section("Main_content")

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت تبلیغ</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/ads" method="post" role="form" id="Form_insert" enctype="multipart/form-data">


            <div class="box-body">
                <div class="form-group">
                    <label>انتخاب دسته اصلی</label>
                    <select class="form-control select2" style="width: 100%;" name="category_id">
                        <option selected="selected">انتخاب کنید</option>
                        @foreach(App\Models\MainCategory::all() as $catagory)
                        <option value="{{ $catagory->id }}"> {{ $catagory->category_name_fa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">عنوان تبلیغ به فارسی</label>
                    <input type="text" name="title_fa" class="form-control" placeholder="عنوان" />
                </div>
                <div class="form-group">
                    <label for="">عنوان تبلیغ به انگلیسی</label>
                    <input type="text" name="title_en" class="form-control" placeholder="عنوان" />
                </div>
                <div class="form-group">
                    <label for="">عنوان تبلیغ به عربی</label>
                    <input type="text" name="title_ar" class="form-control" placeholder="عنوان" />
                </div>
                <div class="form-group">
                    <label for="formFile">عکس</label>
                    <input class="form-control" type="file" id="formFile" name="banner">
                </div>
                <div class="form-group">
                    <label for="">تاریخ انقضا به روز</label>
                    <input type="text" name="expired_at" class="form-control" placeholder="30" />
                </div>
                <div class="form-group">
                    <label for="">لینک</label>
                    <input type="text" name="link" class="form-control" />
                </div>
            </div>
            @csrf
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())

                {{ $errors->first() }}

                @enderror
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ثبت تبلیغ</button>
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
                    <h3 class="box-title">لیست تبلیغات </h3>

                    <div class="box-tools">
                        <form action="/admin/searchAds" method="get">
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
                        @if(count($ads) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام و نام خانوادگی </th>
                                    <th>شماره موبایل</th>
                                    <th>وضعیت</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>قیمت</th>
                                    <th>دسته تبلیغ</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ انقضا</th>
                                    <th>تاریخ باقی مانده</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ads as $ad)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    @if($ad->uploader_type == "user")
                                    <td>{{ $ad->user()->first()->name . ' ' . $ad->user()->first()->family}}</td>
                                    <td>
                                        <a href="/admin/users/{{ $ad->user()->first()->phoneNumber }}/info">
                                            {{ $ad->user()->first()->phoneNumber }}
                                        </a>
                                    </td>
                                    @else
                                    <td>{{ App\Models\Admin::find(session('admin'))->first()->name }}</td>
                                    <td>{{ App\Models\Admin::find(session('admin'))->first()->phoneNumber }}</td>
                                    @endif
                                    @if($ad->status != "تایید شده")
                                    <td class="text-red"> {{ $ad->status }} </td>
                                    @else
                                    <td class="text-green"> {{ $ad->status }} </td>
                                    @endif
                                    @if($ad->payment_status != "پرداخت شده")
                                    <td class="text-red"> {{ $ad->payment_status }} </td>
                                    @else
                                    <td class="text-green"> {{ $ad->payment_status }} </td>
                                    @endif
                                    <td>{{ $ad->price }}</td>

                                    <td>
                                        <a href="/admin/searchMainCategory?searchVal={{ $ad->category()->first()->category_name_fa }}">
                                            {{ $ad->category()->first()->category_name_fa }}
                                        </a>
                                    </td>


                                    @if($ad->created_at != null)
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($ad->created_at) }}</td>
                                    @else
                                    <td>-</td>
                                    @endif

                                    @if($ad->expired_at != null)
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($ad->expired_at) }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    @if($ad->created_at != null && $ad->expired_at != null)
                                    <td>{{ App\Http\Controllers\helper\DateHelper::diffDays($ad->expired_at) }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>
                                        @if($ad->uploader_type != "admin")
                                        <form style="display: inline;" method="post">
                                            @csrf
                                            @method("delete")
                                            <input type="hidden" value="{{ $ad->id }}" class="AdsId">
                                            <button type="submit" class="btn btn-danger deleteBtn2">حذف</button>
                                        </form>
                                        @else
                                        <form style="display: inline;" method="post" action="/admin/ads/{{ $ad->id }}/delete">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        @endif
                                        @if($ad->status == "تایید نشده" && $ad->price == '-')
                                        <div class="btn btn-info">
                                            <a href="/admin/ads/{{ $ad->id }}/addPrice">تعیین قیمت</a>
                                        </div>
                                        @elseif($ad->status == "تایید نشده" && $ad->price != '-')
                                        <div class="btn btn-info">
                                            <a href="/admin/ads/{{ $ad->id }}/accept">تایید کردن</a>
                                        </div>
                                        @else
                                        <div class="btn btn-info">
                                            <a href="/admin/ads/{{ $ad->id }}/edit">ویرایش</a>
                                        </div>
                                        @endif

                                        <div class="btn btn-warning">
                                            <a href="/{{ $ad->banner }}" target="_blank">مشاهده تصویر</a>
                                        </div>
                                        <button type="button" class="btn btn-warning showAdsTextBtn" data-id="{{ $ad->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن تبلیغ</button>
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



<div class="modal modal-warning fade" id="modal-warning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">متن نظر</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">خروج</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection


@section("js_links")

<script defer src="/Tools/Js/calendar.js"></script>
<script defer src="/Tools/Js/jquery.Bootstrap-PersianDateTimePicker.js"></script>
<script defer src="/admin/dist/js/ads/validation.js"></script>
<script defer src="/admin/dist/js/ads/showAdsText.js"></script>
<script defer src="/admin/dist/js/ads/datepicker.js"></script>
<script defer src="/admin/dist/js/ads/checkDelete.js"></script>

@endsection