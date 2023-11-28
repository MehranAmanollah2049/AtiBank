@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت گالری مشاغل")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت عکس مشاغل</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/job/{{ $job->id }}/add_pic" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="formFile" class="form-label">عکس</label>
                    <input class="form-control" type="file" id="formFile" name="file">
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
            </div>
            @csrf
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())

                {{ $errors->first() }}

                @endif
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">آپلود عکس</button>
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
                    <h3 class="box-title">گالری </h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        @if($gallery->count() != 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>توضیحات</th>
                                    <th>تاریخ ثبت</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gallery as $img)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $img->description_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($img->created_at) }} </td>
                                    <td> {{ $img->status }} </td>
                                    <td>

                                        <form style="display: inline;" action="/admin/jobImg/{{ $img->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        @if($img->status == "تایید شده")
                                        <div class="btn btn-info">
                                            <a href="/admin/job/add_pic/{{ $img->id }}/edit">ویرایش</a>
                                        </div>
                                        <div class="btn btn-warning">
                                            <a href="/{{ $img->image }}" target="_blank">مشاهده</a>
                                        </div>


                                        @else

                                        <div class="btn btn-info">
                                            <a href="/admin/job/add_pic/{{ $img->id }}/accept">تایید کردن</a>
                                        </div>

                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="Empty">
                            <span>موردی یافت نشد</span>
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
<script defer src="/admin/dist/js/jobs/validation2.js"></script>

@endsection