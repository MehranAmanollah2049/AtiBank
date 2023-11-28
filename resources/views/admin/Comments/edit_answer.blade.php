@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت دسته ها")

@section("Main_content")



<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">فرم پاسخ گویی به نظرات</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" id="Form_insert" method="post" action="/admin/commentsAnswer/{{ $answer->id }}/edit">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">متن پاسخ گویی</label>
                    <textarea type="text" name="answer_text" class="form-control" id="exampleInputEmail1" placeholder="متن پاسخویی ...">{{ $answer->answer_text }}</textarea>
                </div>
            </div>
            <!-- /.box-body -->
            <p class="error text-red" style="padding: 0 1.2rem;">
            @if($errors->any())

            {{ $errors->first() }}

            @endif
            </p>
            <div class="box-footer">
                <button type="button" class="submitBtn btn btn-primary">ثبت نظر</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section("js_links")

<script defer src="/admin/dist/js/answer_comment/validation.js"></script>

@endsection