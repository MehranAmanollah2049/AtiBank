@extends("admin.Master_layouts.Master")

@section("page_title","پروفایل")

@section("Main_content")


<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ویرایش اطلاعات پروفایل</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="/admin/profile/{{ $admin->id }}/edit" method="post" role="form" id="Form_insert">
            
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">نام</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="نام" value="{{ $admin->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام خانوادگی</label>
                    <input type="text" name="family" class="form-control" id="exampleInputEmail1" placeholder="نام خانوادگی" value="{{ $admin->family }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">نام کاربری</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="نام کاربری" value="{{ $admin->username }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">پسورد</label>
                    <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="پسورد" value="{{ $admin->password }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">شماره موبایل</label>
                    <input type="text" name="phoneNumber" class="form-control" id="exampleInputEmail1" placeholder="شماره موبایل" value="{{ $admin->phoneNumber }}">
                </div>
            </div>
            @csrf
            @method("put")
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
                @if($errors->any())

                {{ $errors->first() }}

                @enderror
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ویرایش</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section("js_links")

<script defer src="/admin/dist/js/profile/validation.js"></script>

@endsection