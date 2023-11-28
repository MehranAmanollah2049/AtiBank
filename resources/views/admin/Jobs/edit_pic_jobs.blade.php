@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت گالری مشاغل")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش عکس مشاغل</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/job/{{ $gallery->id }}/edit_pic" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="formFile" class="form-label">عکس</label>
                    <input class="form-control" type="file" id="formFile" name="file">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به فارسی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_fa" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه">{{ $gallery->description_fa }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به انگلیسی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_en" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه">{{ $gallery->description_en }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">توضیحات کوتاه به عربی</label>
                    <textarea type="text" style="max-width: 100% !important;" name="description_ar" class="form-control" id="exampleInputEmail1" placeholder="متن کوتاه">{{ $gallery->description_ar }}</textarea>
                </div>
            </div>
            @csrf
            @method('put')
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
<script defer src="/admin/dist/js/jobs/validation4.js"></script>

@endsection