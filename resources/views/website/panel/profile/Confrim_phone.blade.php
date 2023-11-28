@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'پروفایل کاربری')

@section('css_links')

<link rel="stylesheet" href="/website/Css/LogIn&SignUp/style.css">
<link rel="stylesheet" href="/website/Css/Panel/profile/confrim_phone.css">

@endsection

@section('panel_content')

<div class="SignUp_right">
    <form action="{{ route('panel.confirm_phone') }}" method="post">
        <div class="changeLangBtn">
            <span>{{ session('lang') }}</span>
            <ion-icon name="globe"></ion-icon>
            <div class="dropDownLang">
                <div class="langOptions"><a href="/changeLanguage/fa">{{ __('message.farsi') }} </a></div>
                <div class="langOptions"><a href="/changeLanguage/en">{{ __('message.english') }}</a></div>
                <div class="langOptions"><a href="/changeLanguage/ar">{{ __('message.arabic') }}</a></div>
            </div>
        </div>
        <p class="title"> {{ __('message.sendCode') }} </p>

        <div class="ints twoSide confrim">
            <input type="text" name="digits1">
            <input type="text" name="digits2">
            <input type="text" name="digits3">
            <input type="text" name="digits4">
            <input type="text" name="digits5">
        </div>
        @csrf
        <div class="resendCodeCon timer">
            <a href="{{ route('panel.resendCode') }}"> {{ __('message.resendCode') }} </a>
            <p></p>
        </div>
        <button type="button" class="signUpBtn"> {{ __('message.sendCode') }} </button>
    </form>
</div>

@endsection


@section("js_links")

<script defer src="/website/Js/logIn&signup/confrim_phone_<?= session('lang') ?>.js"></script>

@endsection





