<!DOCTYPE html>
<html lang="en" class="{{  session('lang') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('website.layouts.MainCssLinks')
    <link rel="stylesheet" href="/website/Css/Menu.css">
    <link rel="stylesheet" href="/website/Css/Footer.css">
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

        <div class="progressBarTop"></div>

        @include("website.layouts.Menu")

        @yield("content")

        @include("website.layouts.Footer")
    </div>

    @include('website.layouts.MainJsLinks')
    <script defer src="/website/Js/Menu_hover.js"></script>
    <script defer src="/website/Js/searchBar.js"></script>
    <script defer src="/website/Js/MenuXSBar.js"></script>
    <script defer src="/website/Js/progressBarTop.js"></script>
    
    <div class="scriptss">
    @yield("js_links")
    </div>


    <script defer src="/Tools/Js/removeLoading.js"></script>

    @include('sweetalert::alert')
</body>

</html>