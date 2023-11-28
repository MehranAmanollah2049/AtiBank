@extends("admin.Master_layouts.Master")

@section("css_links")

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">

@endsection

@section("page_title","مدیریت استان ها")

@section("Main_content")



<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم ویرایش استان</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/state/{{ $state->id }}/edit">
            
            <div class="box-body">
                <div class="form-group">
                    <label>انتخاب کشور</label>
                    <select class="form-control select2" style="width: 100%;" name="country_id">
                        <option>انتخاب کنید</option>
                        @foreach(App\Models\Country::all() as $country) 
                        @if($state->country_id == $country->id) 
                        <option value="{{ $country->id }}" selected> {{ $country->country_name_fa }} </option>
                        @else
                        <option value="{{ $country->id }}"> {{ $country->country_name_fa }} </option>
                        @endif
                       
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام استان به فارسی</label>
                    <input type="text" name="state_name_fa" class="form-control" id="exampleInputEmail1" placeholder="نام استان مورد نظر خود را بنویسید" value="{{ $state->state_name_fa }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام استان به انگلیسی</label>
                    <input type="text" name="state_name_en" class="form-control" id="exampleInputEmail1" placeholder="نام استان مورد نظر خود را بنویسید" value="{{ $state->state_name_en }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام استان به عربی</label>
                    <input type="text" name="state_name_ar" class="form-control" id="exampleInputEmail1" placeholder="نام استان مورد نظر خود را بنویسید" value="{{ $state->state_name_ar }}">
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
                <button type="button" class="submitBtn btn btn-primary">ویرایش اطلاعات</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section("js_links")

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/admin/bower_components/select2/dist/js/script.js"></script>
<script defer src="/admin/dist/js/states/validation.js"></script>

@endsection