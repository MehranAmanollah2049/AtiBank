@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت اسپانسر ها ")

@section("css_links")

<link rel="stylesheet" href="/Tools/Css/jquery.Bootstrap-PersianDateTimePicker.css">

@endsection

@section("Main_content")

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش تبلیغ</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/ads/{{ $ads->id }}" method="post" role="form" id="Form_insert" enctype="multipart/form-data">

            <div class="box-body">
                <div class="form-group">
                    <label>انتخاب دسته اصلی</label>
                    <select class="form-control select2" style="width: 100%;" name="category_id">
                        <option selected="selected">انتخاب کنید</option>
                        @foreach(App\Models\MainCategory::all() as $catagory)
                        <option value="{{ $catagory->id }}" {{ $ads->category_id == $catagory->id ? 'selected' : '' }} > {{ $catagory->category_name_fa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">عنوان تبلیغ به فارسی</label>
                    <input type="text" name="title_fa" class="form-control" placeholder="عنوان" value="{{ $ads->title_fa }}" />
                </div>
                <div class="form-group">
                    <label for="">عنوان تبلیغ به انگلیسی</label>
                    <input type="text" name="title_en" class="form-control" placeholder="عنوان" value="{{ $ads->title_en }}" />
                </div>
                <div class="form-group">
                    <label for="">عنوان تبلیغ به عربی</label>
                    <input type="text" name="title_ar" class="form-control" placeholder="عنوان" value="{{ $ads->title_ar }}" />
                </div>
                <div class="form-group">
                    <label for="formFile">عکس</label>
                    <input class="form-control" type="file" id="formFile" name="banner">
                </div>
                <div class="form-group">
                    <label for="">تاریخ انقضا به روز</label>
                    <input type="text" name="expired_at" class="form-control" placeholder="30" value="{{ $ads->date_end_days }}" />
                </div>
                <div class="form-group">
                    <label for="">لینک</label>
                    <input type="text" name="link" class="form-control" value="{{ $ads->link }}" />
                </div>
                <div class="form-group">
                    <label>وضعیت پرداخت</label>
                    <select class="form-control select2 payment_status" style="width: 100%;" name="payment_status">
                        <option value="">انتخاب کنید</option>
                        <option value="true" {{ $ads->payment_status == "پرداخت شده" ? 'selected' : '' }}>پرداخت شده</option>
                        <option value="false" {{ $ads->payment_status == "پرداخت نشده" ? 'selected' : '' }}>پرداخت نشده</option>
                    </select>
                </div>
            </div>
            @csrf
            @method("put")
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())

                {{ $errors->first() }}

                @enderror
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ویرایش تبلیغ</button>
            </div>
        </form>
    </div>
</div>



@endsection



@section("js_links")

<script defer src="/Tools/Js/calendar.js"></script>
<script defer src="/Tools/Js/jquery.Bootstrap-PersianDateTimePicker.js"></script>
<script defer src="/admin/dist/js/ads/validation3.js"></script>
<script defer src="/admin/dist/js/ads/showAdsText.js"></script>
<script defer src="/admin/dist/js/ads/datepicker.js"></script>

@endsection