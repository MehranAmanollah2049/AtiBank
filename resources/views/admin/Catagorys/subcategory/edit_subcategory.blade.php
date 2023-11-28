@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت دسته های فرعی ")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش دسته های فرعی</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" action="/admin/subcategory/{{ $subcategory->id }}/edit" method="post">

            <div class="box-body">

                <div class="form-group">
                    <label>انتخاب دسته اصلی</label>
                    <select class="form-control select2" style="width: 100%;" name="category_id">
                        <option selected="selected">انتخاب کنید</option>
                        @foreach(App\Models\MainCategory::all() as $catagory)
                        @if($subcategory->category_id == $catagory->id)
                        <option value="{{ $catagory->id }}" selected> {{ $catagory->category_name_fa }} </option>
                        @else
                        <option value="{{ $catagory->id }}"> {{ $catagory->category_name_fa }} </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته فرعی بع فارسی</label>
                    <input type="text" name="subcategory_name_fa" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته فرعی  مورد نظر خود را بنویسید" value="{{ $subcategory->subcategory_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته فرعی به انگلیسی</label>
                    <input type="text" name="subcategory_name_en" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته فرعی  مورد نظر خود را بنویسید" value="{{ $subcategory->subcategory_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته فرعی به عربی</label>
                    <input type="text" name="subcategory_name_ar" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته فرعی  مورد نظر خود را بنویسید" value="{{ $subcategory->subcategory_name_ar }}">
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
<script defer src="/admin/dist/js/subcategory/validation.js"></script>

@endsection