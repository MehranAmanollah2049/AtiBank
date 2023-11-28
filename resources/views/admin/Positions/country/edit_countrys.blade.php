@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت کشور ها")

@section("Main_content")



<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش کشور</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/countrys/{{ $country->id }}/edit">
           
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کشور به فارسی</label>
                    <input type="text" name="country_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام استان مورد نظر خود را بنویسید" value="{{ $country->country_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کشور به انگلیسی</label>
                    <input type="text" name="country_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام استان مورد نظر خود را بنویسید"  value="{{ $country->country_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کشور به عربی</label>
                    <input type="text" name="country_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام استان مورد نظر خود را بنویسید"  value="{{ $country->country_name_ar }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">کد شکاره تلفن کشور</label>
                    <input type="text" name="country_code" class="form-control" id="exampleInputEmail1" placeholder="98"  value="{{ $country->country_code }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">کد مخفف کشور</label>
                    <input type="text" name="country_abbreviation" class="form-control" id="exampleInputEmail1" placeholder="IR" value="{{ $country->country_abbreviation }}">
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
                <button type="button" class="submitBtn btn btn-primary">ویرایش اطلاعات </button>
            </div>
        </form>
    </div>
</div>


@endsection

@section("js_links")

<script defer src="/admin/dist/js/countrys/validation.js"></script>

@endsection