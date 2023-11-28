@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت دسته ها")

@section("Main_content")



<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت دسته اصلی</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/category/add">
            
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته به فارسی</label>
                    <input type="text" name="category_name_fa" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته  مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته به انگلیسی</label>
                    <input type="text" name="category_name_en" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته  مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان دسته به عربی</label>
                    <input type="text" name="category_name_ar" class="form-control" id="exampleInputEmail1" placeholder="عنوان دسته  مورد نظر خود را بنویسید">
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
                <button type="button" class="submitBtn btn btn-primary">ثبت دسته اصلی</button>
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
                    <h3 class="box-title">لیست دسته ها</h3>

                    <div class="box-tools">
                        <form action="/admin/searchMainCategory" method="get">
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
                        @if($categories->count() != 0)

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان دسته</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $category->category_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($category->created_at) }} </td>
                                    <td>
                                        <form style="display: inline;" action="/admin/category/{{ $category->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/catagorys/{{ $category->id }}/edit_main_catagory">ویرایش</a>
                                        </div>
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

<script defer src="/admin/dist/js/main_catagorys/validation.js"></script>

@endsection