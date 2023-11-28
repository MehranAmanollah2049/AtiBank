@extends("admin.Master_layouts.Master")

@section("page_title","داشبورد")

@section("Main_content")

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3> {{ App\Models\Job::all()->count() }} </h3>

                    <p>شغل دارید</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/admin/jobs" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3> {{ App\Models\User::all()->count() }} </h3>

                    <p>کاربر دارید</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>

                <a href="/admin/users" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3> {{ App\Models\Advertising::where("status" , "تایید شده")->where("payment_status" , "پرداخت شده")->where("expired_at" , ">" , now())->get()->count() }} </h3>

                    <p>تبلیغ فعال دارید</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/admin/ads" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <?php
  
                    $userNew = App\Models\User::all();
                    $UsersNewNum = 0;
                    foreach($userNew as $user) {
        
                        if($user->created_at != null) {

                            if($user->created_at->format('Y-m-d') == now()->format('Y-m-d')) {

                                $UsersNewNum += 1;
                            }

                        }
                        
                    }

                    
                    ?>
                    <h3>{{ $UsersNewNum }}</h3>

                    <p>کاربر جدید امروز به جامعه ما اضافه شدن</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/admin/searchUser?seachVal={{ now()->format('Y-m-d') }}" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

</section>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        آمار
        <small>جدیدترین ها</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست مشاغل </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        @if(count(App\Models\Job::all()) != 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>استان</th>
                                    <th>شهر</th>
                                    <th>عنوان دسته اصلی</th>
                                    <th>عنوان دسته فرعی</th>
                                    <th>عنوان شغل</th>
                                    <th>شماره تلفن</th>
                                    <th>تاریخ ثبت</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Job::orderBy("id","DESC")->limit(5)->get() as $job)

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
                                    <td>
                                        <a href="/admin/users/{{ $job->phoneNumber }}/info"> {{ $job->phoneNumber }} </a>
                                    </td>
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