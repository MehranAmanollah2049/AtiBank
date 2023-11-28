@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/dist/css/userList.css">

@endsection

@section("page_title","مدیریت کاربران ")

@section("Main_content")

<div class="User_content">
    @if($user != [])

    <div class="Image" style="background-image: url(<?= $user->profile ?>);"></div>
    <p class="info name"> {{ $user->name . ' ' . $user->family }} </p>
    <p class="info"> {{ $user->phoneNumber }} </p>
    @if($user->jobs()->get()->count() > 0)

    <form style="display: inline;" method="post">
        @csrf
        @method("delete")
        <input type="hidden" class="status" value="yes">
        <input type="hidden" class="userId" value="{{ $user->id }}">
        <div class="btn btn-danger deleteBtnUser">حذف کاربر</div>
    </form>
    @else

    <form style="display: inline;" method="post">
        @csrf
        @method("delete")
        <input type="hidden" class="status" value="no">
        <input type="hidden" class="userId" value="{{ $user->id }}">
        <div class="btn btn-danger deleteBtnUser">حذف کاربر</div>
    </form>
    @endif
    @else
    <div class="Empty">
        <img src="/Tools/Images/website_images/empty.png" alt="">
        <span> این کاربر هنوز در سایت ثبت نام نکرده </span>
    </div>
    @endif
</div>

<!-- Main content -->
<section class="User_content">


    <div class="box" style="width:100%">
        <div class="box-header">
            <h3 class="box-title">لیست مشاغل مربوط به این کاربر </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                @if(App\Models\Job::where("phoneNumber" , $phoneNumber)->get()->count() > 0)
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>استان</th>
                            <th>شهر</th>
                            <th>عنوان دسته اصلی</th>
                            <th>عنوان دسته فرعی</th>
                            <th>عنوان شغل</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tBody>
                        @foreach(App\Models\Job::where("phoneNumber" , $phoneNumber)->get() as $job)

                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td>
                                <a href="/admin/searchState?searchVal={{ $job->city()->first()->state()->first()->state_name_fa }}">
                                    {{ $job->city()->first()->state()->first()->state_name_fa }}
                                </a>
                            </td>
                            <td>
                                <a href="/admin/searchCity?searchVal={{ $job->city()->first()->city_name_fa }}">
                                    {{ $job->city()->first()->city_name_fa }}
                                </a>
                            </td>
                            <td>
                                <a href="/admin/searchMainCategory?searchVal={{ $job->subcategory()->first()->category()->first()->category_name_fa }}">
                                    {{ $job->subcategory()->first()->category()->first()->category_name_fa }}
                                </a>
                            </td>
                            <td>
                                <a href="/admin/searchSubcategory?searchVal={{ $job->subcategory()->first()->subcategory_name_fa }}">
                                    {{ $job->subcategory()->first()->subcategory_name_fa }}
                                </a>
                            </td>
                            <td> {{ $job->job_name_fa }} </td>
                            <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($job->created_at) }} </td>
                            <td>{{ $job->status }} </td>
                            <td>
                                <form style="display: inline;" action="/admin/job/{{ $job->id }}/delete" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                </form>
                                @if($job->status == "تایید نشده")
                                <form style="display: inline;" action="/admin/job/{{ $job->id }}/accept" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-info">تایید کردن</button>
                                </form>
                                @else
                                <div class="btn btn-info">
                                    <a href="/admin/job/{{ $job->id }}/edit_job">ویرایش</a>
                                </div>
                                <div class="btn btn-success">
                                    <a href="/admin/job/{{ $job->id }}/add_pic">عکس ها</a>
                                </div>
                                <div class="btn btn-warning">
                                    <a href="#">مشاهده</a>
                                </div>
                                @endif

                            </td>
                        </tr>

                        @endforeach
                    </tBody>
                </table>
                @else
                <div class="Empty">
                    <img src="/Tools/Images/website_images/empty.png" alt="">
                    <span> هنوز شغلی برای این کاربر ثبت نشده </span>
                </div>
                @endif
            </div>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box" style="width:100%">
        <div class="box-header">
            <h3 class="box-title">لیست نظرات مربوط به این کاربر </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                @if(count($comments) > 0)
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>کد نظر</th>
                            <th>کاربر</th>
                            <th>عنوان شغل</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)

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
                            <td> {{ $comment->status }} </td>
                            <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($comment->created_at) }}</td>
                            <td>
                                <form style="display: inline;" action="/admin/comment/{{ $comment->id }}/delete" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                </form>
                                @if($comment->status == "تایید شده")

                                <div class="btn btn-info">
                                    <a href="/admin/comments/{{ $comment->id }}/{{ $comment->user_id }}/user/answer">پاسخ دادن</a>
                                </div>

                                @else

                                <div class="btn btn-info">
                                    <a href="/admin/comments/{{ $comment->id }}/accept">تایید کردن</a>
                                </div>

                                @endif
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

    <div class="box" style="width:100%">
        <div class="box-header">
            <h3 class="box-title">لیست پاسخ مربوط به این کاربر </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                @if(count($answers) > 0)
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>کد فرستنده</th>
                            <th>کد گیرنده</th>
                            <th>کد نظر</th>
                            <th>عنوان شغل</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($answers as $answer)

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
                            <td> {{ $answer->status }} </td>
                            <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($answer->created_at) }}</td>
                            <td>
                                <form style="display: inline;" action="/admin/answerComment/{{ $answer->id }}/delete" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                </form>
                                @if($answer->type_sender != "admin")

                                @if($answer->status == "تایید شده")

                                <div class="btn btn-info">
                                    <a href="/admin/comments/{{ $answer->comment_id }}/{{ $answer->user_id_sender }}/{{ $answer->type_sender }}/answer">پاسخ دادن</a>
                                </div>

                                @else

                                <div class="btn btn-info">
                                    <a href="/admin/answerComment/{{ $answer->id }}/accept">تایید کردن</a>
                                </div>

                                @endif

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

<script defer src="/admin/dist/js/showCommentText.js"></script>
<script defer src="/admin/dist/js/showAnswerCommentText.js"></script>

@endsection