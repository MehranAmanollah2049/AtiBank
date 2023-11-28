@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'مدیریت نظرات')

@section('css_links')

<link rel="stylesheet" href="/website/Css/Panel/comments/editCmt.css">

@endsection

@section('panel_content')

<div class="EditCon">
    <div class="EditSec">
        <p class="title"> {{ __('message.editCmtTitle') }} </p>
        <form action="/panel/editComment/{{ $comment }}/{{ $type }}" method="post" class="CommentAdd_con Cmt">
            <textarea name="Comment_text" placeholder="{{ __('message.write_your_comment') }}">{{ $text }}</textarea>
            <button type="button" class="addComment_btn">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path d="M12.854.03a12.018 12.018 0 0 0-9.339 3.485A12.023 12.023 0 0 0 .03 12.854C.47 19.208 6.095 24 13.113 24h5.888C21.944 24 24 21.596 24 18.153v-5.815C24 5.869 19.104.463 12.854.03ZM22 18.153C22 20.454 20.795 22 19.001 22h-5.888c-6.052 0-10.715-3.905-11.088-9.285a10.022 10.022 0 0 1 2.904-7.786 10.015 10.015 0 0 1 7.786-2.905C17.922 2.385 22 6.915 22 12.336v5.815ZM17 12a1 1 0 0 1-1 1h-3v3a1 1 0 0 1-2 0v-3H8a1 1 0 0 1 0-2h3V8a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1Z" data-original="#000000" class=""></path>
                    </g>
                </svg>
                {{ __('message.EditCommentBtn') }}
            </button>
            @csrf
        </form>
    </div>
</div>

@endsection


@section("js_links")

<script defer src="/website/Js/Job/validation_comment_<?= session('lang') ?>.js"></script>

@endsection