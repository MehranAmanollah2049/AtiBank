@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت کشور ها")

@section("Main_content")



<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت کشور</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/addCountry" method="post" role="form" id="Form_insert">
            
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کشور به فارسی</label>
                    <input type="text" name="country_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام کشور مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کشور به انگلیسی</label>
                    <input type="text" name="country_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام کشور مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کشور به عربی</label>
                    <input type="text" name="country_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام کشور مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">کد شکاره تلفن کشور</label>
                    <input type="text" name="country_code" class="form-control" id="exampleInputEmail1" placeholder="98">
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
                <button type="button" class="submitBtn btn btn-primary">ثبت کشور</button>
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
                        @if($countrys->count() != 0)
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

                                @foreach($countrys as $country)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $country->country_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($country->created_at) }} </td>
                                    <td>
                                        <form action="/admin/country/{{ $country->id }}/delete" method="post" style="display: inline;">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/positions/{{ $country->id }}/edit_country">ویرایش</a>
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

<script defer src="/admin/dist/js/countrys/validation.js"></script>

@endsection