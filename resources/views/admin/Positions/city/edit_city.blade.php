@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت شهر ها")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش شهر</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/city/{{ $city->id }}/edit" role="form" id="Form_insert" method="post">
            
            <div class="box-body">
    
                <div class="form-group">
                    <label>انتخاب کشور</label>
                    <select class="form-control select2 selectCountry" style="width: 100%;" name="country_id">
                        <option>انتخاب کنید</option>
                        @foreach(App\Models\Country::all() as $country)
                        @if($city->state()->first()->country()->first()->id == $country->id)
                        <option value="{{ $country->id }}" selected>{{ $country->country_name_fa }}</option>
                        @else
                        <option value="{{ $country->id }}">{{ $country->country_name_fa }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>انتخاب استان</label>
                    <select class="form-control select2 selectState" style="width: 100%;" name="state_id">
                        <option>انتخاب کنید</option>
                        @foreach(App\Models\State::where("country_id" , $city->state()->first()->country()->first()->id)->get() as $state) 

                        @if($state->id == $city->state_id)
                        <option value="{{ $state->id }}" selected>{{ $state->state_name_fa }}</option>
                        @else
                        <option value="{{ $state->id }}">{{ $state->state_name_fa }}</option>
                        @endif

                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام شهر به فارسی</label>
                    <input type="text" name="city_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام شهر مورد نظر خود را بنویسید" value="{{ $city->city_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام شهر به انگلیسی</label>
                    <input type="text" name="city_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام شهر مورد نظر خود را بنویسید" value="{{ $city->city_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام شهر به عربی</label>
                    <input type="text" name="city_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام شهر مورد نظر خود را بنویسید" value="{{ $city->city_name_ar }}">
                </div>
            </div>
            @csrf 
            @method("put")
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
            @if($errors->any())
            {{ $errors->first() }}
            @endif
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ویرایش اطلاعات </button>
            </div>
        </form>
    </div>
</div>


@endsection


@section("js_links")

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/admin/bower_components/select2/dist/js/script.js"></script>
<script defer src="/admin/dist/js/citys/validation.js"></script>
<script defer src="/admin/dist/js/citys/GetStates.js"></script>


@endsection