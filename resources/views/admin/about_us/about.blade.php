@extends("admin.Master_layouts.Master")


@section("page_title","درباره ها ")


@section('Main_content')

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">داستان شکل گیری آتی بانک</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_Edit" method="post" action="/admin/about/EditMain/{{ $main_about_text->id }}">

            <div class="box-body">
                <div class="form-group">
                    <label for="">توضیحات کوتاه به فارسی </label>
                    <textarea type="text" style="max-width: 100% !important;" name="content_fa" class="form-control" placeholder="متن کوتاه">{{ $main_about_text->content_fa }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">توضیحات کوتاه به انگلیسی </label>
                    <textarea type="text" style="max-width: 100% !important;" name="content_en" class="form-control" placeholder="متن کوتاه">{{ $main_about_text->content_en }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">توضیحات کوتاه به عربی </label>
                    <textarea type="text" style="max-width: 100% !important;" name="content_ar" class="form-control" placeholder="متن کوتاه">{{ $main_about_text->content_ar }}</textarea>
                </div>
            </div>
            @csrf
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @error('about_main_text')

                {{ $message }}

                @enderror
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ویرایش </button>
            </div>
        </form>
    </div>
</div>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ثبت آیتم</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_Insert" method="post" action="/admin/about/AddItem" enctype="multipart/form-data">


            <div class="box-body">
                <div class="form-group">
                    <label>انتخاب آینم</label>
                    <select class="form-control select2 selectType" style="width: 100%;" name="data_content_type">
                        <option value="عنوان" selected>عنوان</option>
                        <option value="متن">متن</option>
                        <option value="عکس">عکس</option>
                    </select>
                </div>

                <div class="ItemCon titleCon active">
                    <div class="form-group">
                        <label> عنوان به فارسی </label>
                        <input type="text" name="content_fa" class="form-control" placeholder="عنوان" value="{{ old('content_fa') }}">
                    </div>
                    <div class="form-group">
                        <label> عنوان به انگلیسی </label>
                        <input type="text" name="content_en" class="form-control" placeholder="عنوان" value="{{ old('content_en') }}">
                    </div>
                    <div class="form-group">
                        <label> عنوان به عربی </label>
                        <input type="text" name="content_ar" class="form-control" placeholder="عنوان" value="{{ old('content_ar') }}">
                    </div>
                </div>
                <div class="ItemCon textCon">
                    <div class="form-group">
                        <label for="">توضیحات کوتاه به فارسی </label>
                        <textarea type="text" style="max-width: 100% !important;" name="content_text_fa" class="form-control" placeholder="متن کوتاه"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">توضیحات کوتاه به انگلیسی </label>
                        <textarea type="text" style="max-width: 100% !important;" name="content_text_en" class="form-control" placeholder="متن کوتاه"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">توضیحات کوتاه به عربی </label>
                        <textarea type="text" style="max-width: 100% !important;" name="content_text_ar" class="form-control" placeholder="متن کوتاه"></textarea>
                    </div>
                </div>
                
                <div class="ItemCon imgCon">
                    <div class="form-group">
                        <label for="formFile">عکس</label>
                        <input class="form-control" type="file" id="formFile" name="img">
                    </div>
                </div>
            </div>
            @csrf
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

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست آیتم ها</h3>

                    <div class="box-tools">
                        <form action="/admin/searchCountry" method="get">
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
                        @if($aboutAll->count() != 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نوع</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($aboutAll as $about)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $about->data_content_type }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($about->created_at) }} </td>
                                    <td>
                                        <form action="/admin/about/{{ $about->id }}/delete" method="post" style="display: inline;">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/about/edit/{{ $about->id }}">ویرایش</a>
                                        </div>
                                        @if($about->data_content_type == 'متن')
                                        <button type="button" class="btn btn-warning showCommentTextBtn" data-id="{{ $about->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده عنوان </button>
                                        @elseif($about->data_content_type == 'عنوان')
                                        <button type="button" class="btn btn-warning showCommentTextBtn" data-id="{{ $about->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن </button>
                                        @else
                                        <div class="btn btn-warning">
                                            <a href="{{ $about->img }}" target="_blank">مشاهده عکس</a>
                                        </div>
                                        @endif
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
                <p></p>
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

<script defer src="/admin/dist/js/about/validation.js"></script>
<script dfer src="/admin/dist/js/about/pickItem.js"></script>
<script defer src="/admin/dist/js/about/showText.js"></script>

@endsection