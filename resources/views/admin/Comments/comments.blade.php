@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت نظرات ")

@section("Main_content")

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست نظرات تایید شده </h3>

                    <div class="box-tools">
                        <form action="/admin/searchComment" method="get">
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
                        @if($commentsAccepted->count() > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>کد نظر</th>
                                    <th>کاربر</th>
                                    <th>عنوان شغل</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commentsAccepted as $comment)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $comment->id }} </td>
                                    <td>
                                        <a href="/admin/users/{{ $comment->user()->first()->phoneNumber }}/info">
                                            {{ $comment->user()->first()->name . ' ' . $comment->user()->first()->family }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchJob?searchVal={{ $comment->job()->first()->job_name_fa }}">
                                            {{ $comment->job()->first()->job_name_fa }}
                                        </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($comment->created_at) }}</td>
                                    <td>
                                        <form style="display: inline;" action="/admin/comment/{{ $comment->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/comments/{{ $comment->id }}/{{ $comment->user_id }}/user/answer">پاسخ دادن</a>
                                        </div>
                                        <button type="button" class="btn btn-warning showCommentTextBtn" data-id="{{ $comment->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
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

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست نظرات در انتظار تایید </h3>

                    <div class="box-tools">
                        <form action="/admin/searchCommentNotAccepted" method="get">
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
                        @if($commentsNotAccepted->count() > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>کد نظر</th>
                                    <th>کاربر</th>
                                    <th>شغل</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commentsNotAccepted as $comment)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $comment->id }} </td>
                                    <td>
                                        <a href="/admin/users/{{ $comment->user()->first()->phoneNumber }}/info">
                                            {{ $comment->user()->first()->name . ' ' . $comment->user()->first()->family }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchJob?searchVal={{ $comment->job()->first()->job_name_fa }}">
                                            {{ $comment->job()->first()->job_name_fa }}
                                        </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($comment->created_at) }}</td>
                                    <td>
                                        <form style="display: inline;" action="/admin/comment/{{ $comment->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/comments/{{ $comment->id }}/accept">تایید کردن</a>
                                        </div>
                                        <button type="button" class="btn btn-warning showCommentTextBtn" data-id="{{ $comment->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
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

<script defer src="/admin/dist/js/comment/showCommentText.js"></script>

@endsection