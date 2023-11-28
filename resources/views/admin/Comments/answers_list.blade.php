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
                        <form action="/admin/SearchAnswer" method="get">
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
                        @if(count($answersAccepted) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>کد فرستنده</th>
                                    <th>کد گیرنده</th>
                                    <th>کد نظر</th>
                                    <th>عنوان شغل</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($answersAccepted as $answer)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        @if($answer->type_sender == "user")
                                        <a href="/admin/users/{{ $answer->user_sender()->first()->phoneNumber }}/info">
                                            {{ $answer->user_sender()->first()->name . ' ' . $answer->user_sender()->first()->family }}
                                        </a>
                                        @else
                                        ادمین
                                        @endif
                                    </td>
                                    <td>
                                        @if($answer->type_receiver == "user")
                                        <a href="/admin/users/{{ $answer->user_receiver()->first()->phoneNumber }}/info">
                                            {{ $answer->user_receiver()->first()->name . ' ' . $answer->user_receiver()->first()->family }}
                                        </a>
                                        @else
                                        ادمین
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/searchComment?searchVal={{ $answer->comment()->first()->id }}">
                                            {{ $answer->comment_id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchJob?searchVal={{ App\Models\Job::find($answer->comment()->first()->job_id)->first()->job_name_fa }}">
                                            {{ App\Models\Job::find($answer->comment()->first()->job_id)->first()->job_name_fa }}
                                        </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($answer->created_at) }}</td>
                                    <td>
                                        <form style="display: inline;" action="/admin/answerComment/{{ $answer->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        @if($answer->type_sender != "admin")

                                        <div class="btn btn-info">
                                            <a href="/admin/comments/{{ $answer->comment_id }}/{{ $answer->user_id_sender }}/{{ $answer->type_sender }}/answer">پاسخ دادن</a>
                                        </div>

                                        @else

                                        <div class="btn btn-info">
                                            <a href="/admin/commentsAnswer/{{ $answer->id }}/edit">ویرایش متن نظر</a>
                                        </div>

                                        @endif
                                        <button type="button" class="btn btn-warning showAnswerCommentTextBtn" data-id="{{ $answer->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
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
                        <form action="/admin/SearchAnswerNotAccepted" method="get">
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
                        @if(count($answersNotAccepted) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>فرستنده</th>
                                    <th>گیرنده</th>
                                    <th>کد نظر</th>
                                    <th>عنوان شغل</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($answersNotAccepted as $answer)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        @if($answer->type_sender == "user")
                                        <a href="/admin/users/{{ $answer->user_sender()->first()->phoneNumber }}/info">
                                            {{ $answer->user_sender()->first()->name . ' ' . $answer->user_sender()->first()->family }}
                                        </a>
                                        @else
                                        ادمین
                                        @endif
                                    </td>
                                    <td>
                                        @if($answer->type_receiver == "user")
                                        <a href="/admin/users/{{ $answer->user_receiver()->first()->phoneNumber }}/info">
                                            {{ $answer->user_receiver()->first()->name . ' ' . $answer->user_receiver()->first()->family }}
                                        </a>
                                        @else
                                        ادمین
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/searchComment?searchVal={{ $answer->comment()->first()->id }}">
                                            {{ $answer->comment_id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchJob?searchVal={{ App\Models\Job::find($answer->comment()->first()->job_id)->first()->job_name_fa }}">
                                            {{ App\Models\Job::find($answer->comment()->first()->job_id)->first()->job_name_fa }}
                                        </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($answer->created_at) }}</td>
                                    <td>
                                        <form style="display: inline;" action="/admin/answerComment/{{ $answer->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/answerComment/{{ $answer->id }}/accept">تایید کردن</a>
                                        </div>
                                        <button type="button" class="btn btn-warning showAnswerCommentTextBtn" data-id="{{ $answer->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
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

<script defer src="/admin/dist/js/answer_comment/showAnswerCommentText.js"></script>

@endsection