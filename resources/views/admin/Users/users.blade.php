@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت کاربران ")

@section("Main_content")

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست کاربر ها</h3>

                    <div class="box-tools">
                        <form action="/admin/searchUser" method="get">
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
                        @if(count($users) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>شماره موبایل</th>
                                    <th>تعداد شغل ثبت شده</th>
                                    <th>تعداد نظرات ثبت شده</th>
                                    <th>تاریخ ثبت نام</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->family }} </td>
                                    <td style="direction: ltr;"> {{ $user->phoneNumber }} </td>
                                    <td> {{ $user->jobs()->get()->count() }} </td>
                                    <td> {{ $user->comments()->where("status" , "تایید شده")->get()->count() + $user->answersSender()->where("status" , "تایید شده")->get()->count() }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($user->created_at) }} </td>
                                    <td>
                                        <form style="display: inline;" method="post">
                                            @csrf
                                            @method("delete")

                                            @if($user->jobs()->get()->count() > 0)
                                            <input type="hidden" class="status" value="yes">
                                            @else
                                            <input type="hidden" class="status" value="no">
                                            @endif
                                            <input type="hidden" class="userId" value="{{ $user->id }}">
                                            <div class="btn btn-danger deleteBtnUser">حذف</div>
                                        </form>

                                        <div class="btn btn-info">
                                            <a href="/admin/users/{{ $user->phoneNumber }}/info">مشاهده جزئیات</a>
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