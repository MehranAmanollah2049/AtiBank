@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت اسپانسر ها ")

@section("css_links")

<link rel="stylesheet" href="/Tools/Css/jquery.Bootstrap-PersianDateTimePicker.css">

@endsection

@section("Main_content")

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت قیمت برای ثبلغ</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/ads/{{ $ad->id }}/addPrice" method="post" role="form" id="Form_insert">

            <div class="box-body">
                <div class="form-group">
                    <label for="price">مبلغ قابل پرداخت</label>
                    <input class="form-control" type="text" id="price" name="price" placeholder="لطفا مبلغ قابل پرداخت را وارد کنید">
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
                <button type="button" class="submitBtn btn btn-primary">ثبت قیمت</button>
            </div>
        </form>
    </div>
</div>


@endsection


@section("js_links")

<script defer src="/admin/dist/js/ads/validtion2.js"></script>

@endsection