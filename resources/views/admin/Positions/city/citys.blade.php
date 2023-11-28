@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت شهر ها")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ثبت شهر</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/addCity">
            
            <div class="box-body">
                <div class="form-group">
                    <label>انتخاب کشور</label>
                    <select class="form-control select2 selectCountry" style="width: 100%;" name="country_id">
                        <option selected="selected">انتخاب کنید</option>
                        @foreach(App\Models\Country::all() as $country)
                        <option value="{{ $country->id }}"> {{ $country->country_name_fa }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب استان</label>
                    <select class="form-control select2 selectState" style="width: 100%;" name="state_id">
                        <option selected="selected">انتخاب کنید</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام شهر به فارسی</label>
                    <input type="text" name="city_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام شهر مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام شهر به انگلیسی</label>
                    <input type="text" name="city_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام شهر مورد نظر خود را بنویسید">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام شهر به عربی</label>
                    <input type="text" name="city_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام شهر مورد نظر خود را بنویسید">
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
                <button type="button" class="submitBtn btn btn-primary">ثبت شهر</button>
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
                    <h3 class="box-title">لیست شهر ها</h3>

                    <div class="box-tools">
                        <form action="/admin/searchCity" method="get">
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
                        @if(count($citys) != 0)
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
                                @foreach($citys as $city)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <a href="/admin/searchCountry?searchVal={{ $city->state()->first()->country()->first()->country_name_fa }}">
                                        {{ $city->state()->first()->country()->first()->country_name_fa }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/searchState?searchVal={{ $city->state()->first()->state_name_fa }}">
                                        {{ $city->state()->first()->state_name_fa }}
                                        </a>
                                    </td>
                                    <td> {{ $city->city_name_fa }} </td>
                                    <td> {{ App\Http\Controllers\helper\DateHelper::FaConvert($city->created_at) }}  </td>
                                    <td>
                                        <form style="display: inline;" action="/admin/citys/{{ $city->id }}/delete" method="post"  class="deleteForm-{{ $loop->iteration }}">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <div class="btn btn-info">
                                            <a href="/admin/city/{{ $city->id }}/edit_city">ویرایش</a>
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

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/admin/bower_components/select2/dist/js/script.js"></script>
<script defer src="/admin/dist/js/citys/validation.js"></script>
<script defer src="/admin/dist/js/citys/GetStates.js"></script>

@endsection