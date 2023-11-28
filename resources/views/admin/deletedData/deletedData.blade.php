@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت اطلاعات حذف شده ")


@section("Main_content")


<!-- countrys -->
@if(App\Models\Country::onlyTrashed()->get()->count() != 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست کشور ها</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان کشور </th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(App\Models\Country::onlyTrashed()->get() as $country)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $country->country_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($country->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            <a href="/admin/restore/Country/{{ $country->id }}">بازگردانی</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>

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
@endif


<!-- states -->
@if(App\Models\State::onlyTrashed()->get()->count() != 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست استان ها</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">


                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان کشور</th>
                                    <th>عنوان استان</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\State::onlyTrashed()->get() as $state)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <a href="/admin/searchCountry?searchVal={{ $state->country()->withTrashed()->first()->country_name_fa }}">
                                            {{ $state->country()->withTrashed()->first()->country_name_fa }}
                                        </a>
                                    </td>
                                    <td> {{ $state->state_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($state->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($state->country()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/State/{{ $state->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگدان اطلاعات پدر</span>

                                            @endif
                                            
                                        </div>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>



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
@endif


<!-- city -->
@if(App\Models\City::onlyTrashed()->get()->count() != 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست شهر ها</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان کشور</th>
                                    <th>عنوان استان</th>
                                    <th>عنوان شهر</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\City::onlyTrashed()->get() as $city)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <a href="/admin/searchCountry?searchVal={{ $city->state()->withTrashed()->first()->country()->withTrashed()->first()->country_name_fa }}">
                                            {{ $city->state()->withTrashed()->first()->country()->withTrashed()->first()->country_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchState?searchVal={{ $city->state()->withTrashed()->first()->state_name_fa }}">
                                            {{ $city->state()->withTrashed()->first()->state_name_fa }}
                                        </a>
                                    </td>
                                    <td> {{ $city->city_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($city->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($city->state()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/City/{{ $city->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif


<!-- main category -->
@if(App\Models\MainCategory::onlyTrashed()->get()->count() != 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست دسته ها</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">


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
                                @foreach(App\Models\MainCategory::onlyTrashed()->get() as $category)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $category->category_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($category->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            <a href="/admin/restore/MainCategory/{{ $category->id }}">بازگردانی</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif


<!-- subcategory -->
@if(App\Models\Subcategory::onlyTrashed()->get()->count() != 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست دسته های فرعی </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">


                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان دسته اصلی</th>
                                    <th>عنوان دسته فرعی</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Subcategory::onlyTrashed()->get() as $subcategory)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <a href="/admin/searchMainCategory?searchVal={{ $subcategory->category()->withTrashed()->first()->category_name_fa }}">
                                            {{ $subcategory->category()->withTrashed()->first()->category_name_fa }}
                                        </a>
                                    </td>
                                    <td> {{ $subcategory->subcategory_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($subcategory->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($subcategory->category()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Subcategory/{{ $subcategory->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif

<!-- jobs -->
@if(App\Models\Job::onlyTrashed()->get()->count() != 0)
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
                                @foreach(App\Models\Job::onlyTrashed()->get() as $job)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <a href="/admin/searchState?searchVal={{ $job->city()->withTrashed()->first()->state()->withTrashed()->first()->state_name_fa }}">
                                            {{ $job->city()->withTrashed()->first()->state()->withTrashed()->first()->state_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchCity?searchVal={{ $job->city()->withTrashed()->first()->city_name_fa }}">
                                            {{ $job->city()->withTrashed()->first()->city_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchMainCategory?searchVal={{ $job->subcategory()->withTrashed()->first()->category()->withTrashed()->first()->category_name_fa }}">
                                            {{ $job->subcategory()->withTrashed()->first()->category()->withTrashed()->first()->category_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchSubcategory?searchVal={{ $job->subcategory()->withTrashed()->first()->subcategory_name_fa }}">
                                            {{ $job->subcategory()->withTrashed()->first()->subcategory_name_fa }}
                                        </a>
                                    </td>
                                    <td> {{ $job->job_name_fa }} </td>
                                    <td>
                                        <a href="/admin/users/{{ $job->phoneNumber }}/info"> {{ $job->phoneNumber }} </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($job->created_at) }} </td>
                                    <td>{{ $job->status }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($job->city()->withTrashed()->first()->deleted_at == null && $job->subcategory()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Job/{{ $job->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif

<!-- job gallery -->
@if(App\Models\JobGallery::onlyTrashed()->get()->count() != 0)
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

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>توضیحات</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\JobGallery::onlyTrashed()->get() as $img)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $img->description_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($img->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($img->job()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/JobGallery/{{ $img->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif
                                        </div>
                                        <div class="btn btn-warning">
                                            <a href="/{{ $img->image }}" target="_blank">مشاهده</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif

<!-- users -->
@if(App\Models\User::onlyTrashed()->get()->count() > 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست کاربر ها</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

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
                                @foreach(App\Models\User::onlyTrashed()->get() as $user)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->family }} </td>
                                    <td> {{ $user->phoneNumber }} </td>
                                    <td> {{ $user->jobs()->get()->count() }} </td>
                                    <td> {{ $user->comments()->where("status" , "تایید شده")->get()->count() + $user->answersSender()->where("status" , "تایید شده")->get()->count() }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($user->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            <a href="/admin/restore/User/{{ $user->id }}">بازگردانی</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif


<!-- comments -->
@if(App\Models\Comment::onlyTrashed()->get()->count() > 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست نظرات  </h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

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
                                @foreach(App\Models\Comment::onlyTrashed()->get() as $comment)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $comment->id }} </td>
                                    <td>
                                        <a href="/admin/users/{{ $comment->user()->withTrashed()->first()->phoneNumber }}/info">
                                            {{ $comment->user()->withTrashed()->first()->name . ' ' . $comment->user()->withTrashed()->first()->family }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchJob?searchVal={{ $comment->job()->withTrashed()->first()->job_name_fa }}">
                                            {{ $comment->job()->withTrashed()->first()->job_name_fa }}
                                        </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($comment->created_at) }}</td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($comment->job()->withTrashed()->first()->deleted_at == null && $comment->user()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Comment/{{ $comment->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-warning showCommentTextBtn" data-id="{{ $comment->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>


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
@endif

<!-- Answers -->
@if(App\Models\Answer::onlyTrashed()->get()->count() > 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست نظرات  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

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
                                @foreach(App\Models\Answer::onlyTrashed()->get() as $answer)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        @if($answer->type_sender == "user")
                                        <a href="/admin/users/{{ $answer->user_sender()->withTrashed()->first()->phoneNumber }}/info">
                                            {{ $answer->user_sender()->withTrashed()->first()->name . ' ' . $answer->user_sender()->withTrashed()->first()->family }}
                                        </a>
                                        @else
                                        ادمین
                                        @endif
                                    </td>
                                    <td>
                                        @if($answer->type_receiver == "user")
                                        <a href="/admin/users/{{ $answer->user_receiver()->withTrashed()->first()->phoneNumber }}/info">
                                            {{ $answer->user_receiver()->withTrashed()->first()->name . ' ' . $answer->user_receiver()->withTrashed()->first()->family }}
                                        </a>
                                        @else
                                        ادمین
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/searchComment?searchVal={{ $answer->comment()->withTrashed()->first()->id }}">
                                            {{ $answer->comment_id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchJob?searchVal={{ App\Models\Job::find($answer->comment()->withTrashed()->first()->job_id)->withTrashed()->first()->job_name_fa }}">
                                            {{ App\Models\Job::find($answer->comment()->withTrashed()->first()->job_id)->withTrashed()->first()->job_name_fa }}
                                        </a>
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($answer->created_at) }}</td>
                                    <td>
                                        <div class="btn btn-info">
                                            @if($answer->type_sender == 'user' && $answer->type_receiver == 'admin')

                                            @if($answer->comment()->withTrashed()->first()->deleted_at == null && $answer()->user_sender()->withTrashed()->first()->deleted_at == null && App\Models\Admin::where('id' , $answer->user_id_receiver)->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Answer/{{ $answer->id }}">بازگردانی</a>


                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif

                                            @elseif($answer->type_sender == 'admin' && $answer->type_receiver == 'user')


                                            @if($answer->comment()->withTrashed()->first()->deleted_at == null && $answer()->user_receiver()->withTrashed()->first()->deleted_at == null && App\Models\Admin::where('id' , $answer->user_id_sender)->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Answer/{{ $answer->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif

                                            @elseif($answer->type_sender == 'user' && $answer->type_receiver == 'user')

                                            @if($answer->comment()->withTrashed()->first()->deleted_at == null && $answer()->user_sender()->withTrashed()->first()->deleted_at == null && $answer()->user_receiver()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Answer/{{ $answer->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif

                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-warning showAnswerCommentTextBtn" data-id="{{ $answer->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>

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
@endif


<!-- ads -->
@if(App\Models\Advertising::onlyTrashed()->get()->count() > 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست تبلیغات </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام و نام خانوادگی </th>
                                    <th>شماره موبایل</th>
                                    <th>وضعیت</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>قیمت</th>
                                    <th>دسته تبلیغ</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ انقضا</th>
                                    <th>تاریخ باقی مانده</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Advertising::onlyTrashed()->get() as $ad)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    @if($ad->uploader_type == "user")
                                    <td>{{ $ad->user()->withTrashed()->first()->name . ' ' . $ad->user()->withTrashed()->first()->family}}</td>
                                    <td>
                                        <a href="/admin/users/{{ $ad->user()->withTrashed()->first()->phoneNumber }}/info">
                                            {{ $ad->user()->withTrashed()->first()->phoneNumber }}
                                        </a>
                                    </td>
                                    @else
                                    <td>{{ App\Models\Admin::find(session('admin'))->withTrashed()->first()->name }}</td>
                                    <td>{{ App\Models\Admin::find(session('admin'))->withTrashed()->first()->phoneNumber }}</td>
                                    @endif
                                    @if($ad->status != "تایید شده")
                                    <td class="text-red"> {{ $ad->status }} </td>
                                    @else
                                    <td class="text-green"> {{ $ad->status }} </td>
                                    @endif
                                    @if($ad->payment_status != "پرداخت شده")
                                    <td class="text-red"> {{ $ad->payment_status }} </td>
                                    @else
                                    <td class="text-green"> {{ $ad->payment_status }} </td>
                                    @endif
                                    <td>{{ $ad->price }}</td>

                                    <td>
                                        <a href="/admin/searchMainCategory?searchVal={{ $ad->category()->withTrashed()->first()->category_name_fa }}">
                                            {{ $ad->category()->withTrashed()->first()->category_name_fa }}
                                        </a>
                                    </td>


                                    @if($ad->created_at != null)
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($ad->created_at) }}</td>
                                    @else
                                    <td>-</td>
                                    @endif

                                    @if($ad->expired_at != null)
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($ad->expired_at) }}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    @if($ad->created_at != null && $ad->expired_at != null)
                                    <td>{{ App\Http\Controllers\helper\DateHelper::diffDays($ad->created_at,$ad->expired_at) }} روز</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>
                                        <div class="btn btn-info">
                                            @if($ad->uploader_type == 'user')

                                            @if($ad->user()->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Advertising/{{ $ad->id }}">بازگردانی</a>

                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif

                                            @elseif($ad->uploader_type == 'admin')

                                            @if(App\Models\Admin::where('id' , $ad->user_id)->withTrashed()->first()->deleted_at == null)

                                            <a href="/admin/restore/Advertising/{{ $ad->id }}">بازگردانی</a>
                                            
                                            @else

                                            <span>در انتظار بازگردانی اطلاعات پدر</span>

                                            @endif

                                            @endif
                                        </div>

                                        <div class="btn btn-warning">
                                            <a href="/{{ $ad->banner }}" target="_blank">مشاهده تصویر</a>
                                        </div>
                                        <button type="button" class="btn btn-warning showAdsTextBtn" data-id="{{ $ad->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن تبلیغ</button>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif

<!-- call requests -->
@if(App\Models\Contact::onlyTrashed()->get()->count() > 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست درخواست ها </h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام </th>
                                    <th>نام خانوادگی</th>
                                    <th>شماره موبایل</th>
                                    <th>ایمیل</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Contact::onlyTrashed()->get() as $contact)

                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->family }}</td>
                                    <td>
                                        @if(App\Models\User::where("phoneNumber" , $contact->phoneNumber)->withTrashed()->first() != [])

                                        <a href="/admin/users/{{ $contact->phoneNumber }}/info">
                                            {{ $contact->phoneNumber }}
                                        </a>

                                        @else
                                        {{ $contact->phoneNumber }}
                                        @endif
                                    </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ App\Http\Controllers\daate\DateHelper::FaConvert($contact->created_at) }}</td>
                                    <td>
                                        <div class="btn btn-info">
                                            <a href="/admin/restore/Contact/{{ $contact->id }}">بازگردانی</a>
                                        </div>
                                        <button type="button" class="btn btn-warning showContactTextBtn" data-id="{{ $contact->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن نظر</button>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>


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
@endif

<!-- about us -->
@if(App\Models\AboutUs::onlyTrashed()->get()->count() != 0)
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست کشور ها</h3>

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

                                @foreach(App\Models\AboutUs::onlyTrashed()->get() as $about)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $about->data_content_type }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($about->created_at) }} </td>
                                    <td>
                                        <div class="btn btn-info">
                                            <a href="/admin/restore/AboutUs/{{ $about->id }}">بازگردانی</a>
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
@endif


@if(App\Models\Country::onlyTrashed()->get()->count() == 0 && App\Models\State::onlyTrashed()->get()->count() == 0 && App\Models\City::onlyTrashed()->get()->count() == 0 && App\Models\MainCategory::onlyTrashed()->get()->count() == 0 && App\Models\Subcategory::onlyTrashed()->get()->count() == 0 && App\Models\Job::onlyTrashed()->get()->count() == 0 && App\Models\JobGallery::onlyTrashed()->get()->count() == 0 && App\Models\User::onlyTrashed()->get()->count() == 0 && App\Models\Comment::onlyTrashed()->get()->count() == 0 && App\Models\Answer::onlyTrashed()->get()->count() == 0 && App\Models\Advertising::onlyTrashed()->get()->count() == 0 && App\Models\Contact::onlyTrashed()->get()->count() == 0 && App\Models\AboutUs::onlyTrashed()->get()->count() == 0)

<div class="Empty">
    <img src="/Tools/Images/website_images/empty.png" alt="">
    <span> موردی یافت نشد </span>
</div>

@endif


<div class="modal modal-warning fade" id="modal-warning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">متن </h4>
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
<script defer src="/admin/dist/js/answer_comment/showAnswerCommentText.js"></script>
<script defer src="/admin/dist/js/ticket/showTicketText.js"></script>
<script defer src="/admin/dist/js/ads/showAdsText.js"></script>
<script defer src="/admin/dist/js/contact/showContactText.js"></script>
<script defer src="/admin/dist/js/about/showText.js"></script>


@endsection