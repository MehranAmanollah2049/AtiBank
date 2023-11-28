@extends("admin.Master_layouts.Master")


@section("page_title","درباره ها ")


@section('Main_content')


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ثبت آیتم</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_Insert" method="post" action="/admin/about/{{ $about->id }}/edit" enctype="multipart/form-data">


            <div class="box-body">
                <div class="form-group">
                    <label>انتخاب آینم</label>
                    <select class="form-control select2 selectType" style="width: 100%;" name="data_content_type">
                        <option value="عنوان" {{ $about->data_content_type == 'عنوان' ? 'selected' : '' }}>عنوان</option>
                        <option value="متن" {{ $about->data_content_type == 'متن' ? 'selected' : '' }}>متن</option>
                        <option value="عکس" {{ $about->data_content_type == 'عکس' ? 'selected' : '' }}>عکس</option>
                    </select>
                </div>

                <div class="ItemCon titleCon {{ $about->data_content_type == 'عنوان' ? 'active' : '' }} ">
                    <div class="form-group">
                        <label> عنوان به فارسی </label>
                        <input type="text" name="content_fa" class="form-control" placeholder="عنوان"  value="{{ $about->data_content_type == 'عنوان' ? $about->content_fa : '' }}" >
                    </div>
                    <div class="form-group">
                        <label> عنوان به انگلیسی </label>
                        <input type="text" name="content_en" class="form-control" placeholder="عنوان" value="{{ $about->data_content_type == 'عنوان' ? $about->content_en : '' }}">
                    </div>
                    <div class="form-group">
                        <label> عنوان به عربی </label>
                        <input type="text" name="content_ar" class="form-control" placeholder="عنوان" value="{{ $about->data_content_type == 'عنوان' ? $about->content_ar : '' }}">
                    </div>
                </div>

                <div class="ItemCon textCon {{ $about->data_content_type == 'متن' ? 'active' : '' }}">
                    <div class="form-group">
                        <label for="">توضیحات کوتاه به فارسی </label>
                        <textarea type="text" style="max-width: 100% !important;" name="content_text_fa" class="form-control" placeholder="متن کوتاه">{{ $about->data_content_type == 'متن' ? $about->content_fa : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">توضیحات کوتاه به انگلیسی </label>
                        <textarea type="text" style="max-width: 100% !important;" name="content_text_en" class="form-control" placeholder="متن کوتاه">{{ $about->data_content_type == 'متن' ? $about->content_fa : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">توضیحات کوتاه به عربی </label>
                        <textarea type="text" style="max-width: 100% !important;" name="content_text_ar" class="form-control" placeholder="متن کوتاه">{{ $about->data_content_type == 'متن' ? $about->content_fa : '' }}</textarea>
                    </div>
                </div>
             
                <div class="ItemCon imgCon {{ $about->data_content_type == 'عکس' ? 'active' : '' }}">
                    <div class="form-group">
                        <label for="formFile">عکس</label>
                        <input class="form-control" type="file" id="formFile" name="img">
                    </div>
                </div>
            </div>
            @csrf
            @method('put')
            <!-- /.box-body -->
            <p class="error error2 text-red" style="padding: 0 1.2rem;">
                @error('about_main_text')

                {{ $message }}

                @enderror
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn2 btn btn-primary">ثبت آیتم</button>
            </div>
        </form>
    </div>
</div>


@endsection


@section("js_links")

<script dfer src="/admin/dist/js/about/pickItem.js"></script>

@endsection