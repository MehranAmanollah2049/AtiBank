<!DOCTYPE html>
<html lang="en" class="{{  session('lang') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('website.layouts.MainCssLinks')
    <link rel="stylesheet" href="/website/Css/Panel/PanelMain.css">
    @yield("css_links")
    <title>آتی بانک - @yield('title_page')</title>
</head>

<body>
    <div class="containerAll">

        <div class="loadingCon active">
            <div class="spinnerloaderSec">
                <div class="spinner_loader"></div>
            </div>
        </div>

        <div class="container_panel">
            <div class="Right_container_all">
                <div class="logoWeb">
                     <img src="/Tools/Images/Website_images/AtiLogo.png" class="svgLogo" alt="Ati Bank">
                    <div class="ExitMenuXSbTN">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512.021 512.021" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M301.258 256.01 502.645 54.645c12.501-12.501 12.501-32.769 0-45.269-12.501-12.501-32.769-12.501-45.269 0L256.01 210.762 54.645 9.376c-12.501-12.501-32.769-12.501-45.269 0s-12.501 32.769 0 45.269L210.762 256.01 9.376 457.376c-12.501 12.501-12.501 32.769 0 45.269s32.769 12.501 45.269 0L256.01 301.258l201.365 201.387c12.501 12.501 32.769 12.501 45.269 0 12.501-12.501 12.501-32.769 0-45.269L301.258 256.01z" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="MenuBar_options_right">
                    <div class="top_options">
                        <div class="MenuBar_options {{ $sideBarPanel == 'jobs_manage' ? 'active' : '' }}">
                            <a href="/panel/JobMangement">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path d="M19 4h-1.1A5.009 5.009 0 0 0 13 0h-2a5.009 5.009 0 0 0-4.9 4H5a5.006 5.006 0 0 0-5 5v10a5.006 5.006 0 0 0 5 5h14a5.006 5.006 0 0 0 5-5V9a5.006 5.006 0 0 0-5-5Zm-8-2h2a3 3 0 0 1 2.816 2H8.184A3 3 0 0 1 11 2ZM5 6h14a3 3 0 0 1 3 3v3H2V9a3 3 0 0 1 3-3Zm14 16H5a3 3 0 0 1-3-3v-5h9v1a1 1 0 0 0 2 0v-1h9v5a3 3 0 0 1-3 3Z" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                                <span> {{ __('message.jobs_manage') }} </span>
                            </a>
                        </div>
                        <div class="MenuBar_options {{ $sideBarPanel == 'favorite_list' ? 'active' : '' }}">
                            <a href="/panel/Job/favorateList/show">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path d="M7 0H4C1.79 0 0 1.79 0 4v3c0 2.21 1.79 4 4 4h3c2.21 0 4-1.79 4-4V4c0-2.21-1.79-4-4-4Zm2 7c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h3c1.1 0 2 .9 2 2v3Zm11 6h-3c-2.21 0-4 1.79-4 4v3c0 2.21 1.79 4 4 4h3c2.21 0 4-1.79 4-4v-3c0-2.21-1.79-4-4-4Zm2 7c0 1.1-.9 2-2 2h-3c-1.1 0-2-.9-2-2v-3c0-1.1.9-2 2-2h3c1.1 0 2 .9 2 2v3ZM7 13H4c-2.21 0-4 1.79-4 4v3c0 2.21 1.79 4 4 4h3c2.21 0 4-1.79 4-4v-3c0-2.21-1.79-4-4-4Zm2 7c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2v-3c0-1.1.9-2 2-2h3c1.1 0 2 .9 2 2v3Zm8.18-10.47c.38.31.85.46 1.32.46s.94-.15 1.32-.46C21.38 8.28 24 5.83 24 3.47c0-1.92-1.46-3.48-3.25-3.48-.85 0-1.65.36-2.25.94-.59-.59-1.39-.94-2.25-.94C14.46-.01 13 1.55 13 3.47c0 2.35 2.62 4.81 4.18 6.06ZM16.25 2c.6 0 1.14.5 1.26 1.17.08.48.5.83.98.83s.9-.35.98-.83c.12-.67.67-1.17 1.27-1.17.69 0 1.25.66 1.25 1.48 0 1.06-1.35 2.83-3.43 4.5a.12.12 0 0 1-.14 0c-2.08-1.67-3.43-3.44-3.43-4.5 0-.81.56-1.48 1.25-1.48Z" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                                <span> {{ __('message.favorite_list_title') }} </span>
                            </a>
                        </div>
                        <div class="MenuBar_options {{ $sideBarPanel == 'comments_manage' ? 'active' : '' }}">
                            <a href="/panel/User/comments">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path d="M20 0H4a4 4 0 0 0-4 4v12a4 4 0 0 0 4 4h2.9l4.451 3.763a1 1 0 0 0 1.292 0L17.1 20H20a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 16a2 2 0 0 1-2 2h-2.9a2 2 0 0 0-1.291.473L12 21.69l-3.807-3.217A2 2 0 0 0 6.9 18H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2Z" data-original="#000000" class=""></path>
                                        <path d="M7 7h5a1 1 0 0 0 0-2H7a1 1 0 0 0 0 2ZM17 9H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2ZM17 13H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2Z" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                                <span> {{ __('message.comments_manage') }} </span>
                            </a>
                        </div>
                        <div class="MenuBar_options {{ $sideBarPanel == 'tickets_manage' ? 'active' : '' }}">
                            <a href="/panel/massenger">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path d="M23.119.882a2.966 2.966 0 0 0-2.8-.8l-16 3.37a4.995 4.995 0 0 0-2.853 8.481l1.718 1.717a1 1 0 0 1 .293.708v3.168a2.965 2.965 0 0 0 .3 1.285l-.008.007.026.026A3 3 0 0 0 5.157 20.2l.026.026.007-.008a2.965 2.965 0 0 0 1.285.3h3.168a1 1 0 0 1 .707.292l1.717 1.717A4.963 4.963 0 0 0 15.587 24a5.049 5.049 0 0 0 1.605-.264 4.933 4.933 0 0 0 3.344-3.986l3.375-16.035a2.975 2.975 0 0 0-.792-2.833ZM4.6 12.238l-1.719-1.717a2.94 2.94 0 0 1-.722-3.074 2.978 2.978 0 0 1 2.5-2.026L20.5 2.086 5.475 17.113v-2.755a2.978 2.978 0 0 0-.875-2.12Zm13.971 7.17a3 3 0 0 1-5.089 1.712l-1.72-1.72a2.978 2.978 0 0 0-2.119-.878H6.888L21.915 3.5Z" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                                <span> {{ __('message.tickets_manage') }} </span>
                            </a>
                        </div>
                        <div class="MenuBar_options contactUs">
                            <a href="/contactUs">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM7 13h5M7 17h9" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14 2H9C4 2 2 4 2 9v6c0 5 2 7 7 7h6c5 0 7-2 7-7v-5" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span> {{ __('message.addAds') }} </span>
                            </a>
                        </div>
                        <div class="MenuBar_options {{ $sideBarPanel == 'profile_manage' ? 'active' : '' }}">
                            <a href="/panel/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path d="M9 12c3.309 0 6-2.691 6-6s-2.691-6-6-6-6 2.691-6 6 2.691 6 6 6ZM9 2c2.206 0 4 1.794 4 4s-1.794 4-4 4-4-1.794-4-4 1.794-4 4-4Zm1.75 14.22A7.008 7.008 0 0 0 2 23a1 1 0 0 1-2 0c0-4.962 4.038-9 9-9 .762 0 1.519.095 2.25.284a1 1 0 0 1-.499 1.937Zm12.371-4.341c-1.134-1.134-3.11-1.134-4.243 0l-6.707 6.707a3.976 3.976 0 0 0-1.172 2.829v1.586a1 1 0 0 0 1 1h1.586a3.973 3.973 0 0 0 2.828-1.172l6.707-6.707c.567-.567.879-1.32.879-2.122s-.312-1.555-.878-2.121Zm-1.415 2.828-6.708 6.707a1.983 1.983 0 0 1-1.414.586h-.586v-.586c0-.534.208-1.036.586-1.414l6.708-6.707a1.023 1.023 0 0 1 1.414 0c.189.188.293.439.293.707s-.104.518-.293.707Z" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                                <span> {{ __('message.profile_manage') }} </span>
                            </a>
                        </div>
                    </div>
                    <div class="MenuBar_options logOut">
                        <a href="/logout">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M22.829 9.172 18.95 5.293a1 1 0 0 0-1.414 1.414l3.879 3.879a2.057 2.057 0 0 1 .3.39c-.015 0-.027-.008-.042-.008L5.989 11a1 1 0 0 0 0 2l15.678-.032c.028 0 .051-.014.078-.016a2 2 0 0 1-.334.462l-3.879 3.879a1 1 0 1 0 1.414 1.414l3.879-3.879a4 4 0 0 0 0-5.656Z" data-original="#000000" class=""></path>
                                    <path d="M7 22H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h2a1 1 0 0 0 0-2H5a5.006 5.006 0 0 0-5 5v14a5.006 5.006 0 0 0 5 5h2a1 1 0 0 0 0-2Z" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                            <span> {{ __('message.logout_panel') }} </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="Left_container_all">
                <div class="topMenuAll_Left">
                    <div class="MenuBarXS">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M7 0H4a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM20 0h-3a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM7 13H4a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4v-3a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM20 13h-3a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4v-3a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2Z"  data-original="#000000" class=""></path>
                            </g>
                        </svg>
                    </div>
                    <p class="sayHi">
                        {{ __('message.sayHi' , ['name' => auth()->user()->name]) }}
                    </p>
                    <div class="left_boxs">
                        <div class="changeLangBtn">
                            <ion-icon name="globe"></ion-icon>
                            <div class="dropDownLang">
                                <div class="langOptions"><a href="/changeLanguage/fa">{{ __('message.farsi') }} </a></div>
                                <div class="langOptions"><a href="/changeLanguage/en">{{ __('message.english') }}</a></div>
                                <div class="langOptions"><a href="/changeLanguage/ar">{{ __('message.arabic') }}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="BottomAll_Left">
                    @yield('panel_content')
                </div>
            </div>
        </div>

        <div class="overlayMenuXS"></div>

    </div>

    @include('website.layouts.MainJsLinks')
    <script defer src="/website/Js/panel/MenuXS.js"></script>
    @yield("js_links")


    <script defer src="/Tools/Js/removeLoading.js"></script>

    @include('sweetalert::alert')
</body>

</html>