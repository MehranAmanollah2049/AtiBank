@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت دسته ها")

@section("Main_content")



<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش دسته اصلی</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/category/{{ $category->id }}/edit">
           
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته به فارسی</label>
                    <input type="text" name="category_name_fa" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته  مورد نظر خود را بنویسید" value="{{ $category->category_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته به انگلیسی</label>
                    <input type="text" name="category_name_en" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته  مورد نظر خود را بنویسید" value="{{ $category->category_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته به عربی</label>
                    <input type="text" name="category_name_ar" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته  مورد نظر خود را بنویسید" value="{{ $category->category_name_ar }}">
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

<script defer src="/admin/dist/js/main_catagorys/validation.js"></script>

@endsection