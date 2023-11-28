@extends("admin.Master_layouts.Master")

@section("page_title","درخواست های تماس")

@section("Main_content")

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم مدیریت صفحه ارتباط باما  </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/contact_us_infos" method="post" role="form" id="Form_insert">


            <div class="box-body">
    
                <div class="form-group">
                    <label for="">آدرس اینستاگرام</label>
                    <input type="text" name="insta_name" class="form-control" placeholder="آدرس" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->insta_name : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">لینک اینستاگرام</label>
                    <input type="text" name="insta_link" class="form-control" placeholder="لینک" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->insta_link : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">آدرس ایمیل</label>
                    <input type="text" name="email_name" class="form-control" placeholder="آدرس" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->email_name : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">لینک ایمیل</label>
                    <input type="text" name="email_link" class="form-control" placeholder="لینک" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->email_link : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">آدرس تلگرام</label>
                    <input type="text" name="telegram_name" class="form-control" placeholder="آدرس" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->telegram_name : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">لینک تلگرام</label>
                    <input type="text" name="telegram_link" class="form-control" placeholder="لینک" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->telegram_link : '' }}" />
                </div>

                <div class="form-group">
                    <label for="">شماره تلفن</label>
                    <input type="text" name="phones" class="form-control" placeholder="شماره تلفن" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->phones : '' }}" />
                </div>

                <div class="form-group">
                    <label for="">آدرس به فارسی</label>
                    <input type="text" name="address_fa" class="form-control" placeholder="آدرس دفتر" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->addresse_fa : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">آدرس به انگلیسی</label>
                    <input type="text" name="address_en" class="form-control" placeholder="آدرس دفتر" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->addresse_en : '' }}" />
                </div>
                <div class="form-group">
                    <label for="">آدرس به عربی</label>
                    <input type="text" name="address_ar" class="form-control" placeholder="آدرس دفتر" value="{{ App\Models\ContactUsInfos::all()->first() != null ? App\Models\ContactUsInfos::all()->first()->addresse_ar : '' }}" />
                </div>
            </div>
            @csrf
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())

                {{ $errors->first() }}

                @enderror
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ثبت اطلاعات</button>
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
                    <h3 class="box-title">لیست درخواست ها </h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="جستجو">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        @if(count($contacts) > 0)
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
                                @foreach($contacts as $contact)

                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->family }}</td>
                                    <td style='direction:ltr'>
                                        @if(App\Models\User::where("phoneNumber" , $contact->phoneNumber)->first() != [])

                                        <a href="/admin/users/{{ $contact->phoneNumber }}/info" >
                                            {{ $contact->phoneNumber }}
                                        </a>

                                        @else
                                            {{ $contact->phoneNumber }}
                                        @endif
                                    </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($contact->created_at) }}</td>
                                    <td>
                                        <form style="display: inline;" action="/admin/contact/{{ $contact->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <button type="button" class="btn btn-warning showContactTextBtn" data-id="{{ $contact->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده متن درخواست</button>
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
                <p>محتوا</p>
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

<script defer src="/admin/dist/js/contact/showContactText.js"></script>
<script defer src="/admin/dist/js/contact/validation.js"></script>

@endsection