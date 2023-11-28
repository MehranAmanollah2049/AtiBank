<!DOCTYPE html>
<html lang="en" class="{{  session('lang') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Tools/Css/styleAll.css">
    <link rel="stylesheet" href="/website/Css/LogIn&SignUp/style.css">
    <title>{{ __('message.confrimCodeTitle') }}</title>
</head>

<body>
    <div class="containerAll">

        <div class="loadingCon active">
            <div class="spinnerloaderSec">
                <div class="spinner_loader"></div>
            </div>
        </div>

        <div class="SignUp_right">
            <form action="{{ route('auth.confirm_phone') }}" method="post">
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
                {{ session('code') }}
                @csrf
                <div class="resendCodeCon timer">
                    <a href="{{ route('auth.resendCode') }}"> {{ __('message.resendCode') }} </a>
                    <p></p>
                </div>
                <button type="button" class="signUpBtn"> {{ __('message.sendCode') }} </button>
            </form>
        </div>
        <div class="SignUp_left">
            <div class="menu_glass">
                <div class="right">
                    <div class="glass_menu_btns joinUs">
                        <a href="{{ route('auth.signup.show') }}">
                            {{ __('message.signup2') }}
                        </a>
                    </div>
                    <div class="glass_menu_btns logIn active">
                        <a href="{{ route('auth.login.show') }}">
                            {{ __('message.logIn') }}
                        </a>
                    </div>
                </div>
                <div class="changeLangBtn">
                    <span>{{ session('lang') }}</span>
                    <ion-icon name="globe"></ion-icon>
                    <div class="dropDownLang">
                        <div class="langOptions"><a href="/changeLanguage/fa">{{ __('message.farsi') }} </a></div>
                        <div class="langOptions"><a href="/changeLanguage/en">{{ __('message.english') }}</a></div>
                        <div class="langOptions"><a href="/changeLanguage/ar">{{ __('message.arabic') }}</a></div>
                    </div>
                </div>
            </div>
            <div class="welcome_section">
                <p class="title"> {!! __('message.welcome_text2') !!} </p>
                <p class="about"> {{ __('message.signUp_text') }} </p>
            </div>
            <!-- particles.js container -->
            <div id="particles-js"></div>
        </div>
    </div>


    <script defer src="/Tools/Js/Jquery.js"></script>
    <script defer type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> <!-- Ion Icon Link -->
    <script defer nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> <!-- Ion Icon Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Js sweetalert link -->
    <script defer src="/website/Js/logIn&signup/confrim_phone_<?= session('lang') ?>.js"></script>
    <script defer src="/Tools/Js/particles.js"></script>
    <script defer src="/website/Js/logIn&signup/bgAnimation.js"></script>
    <script defer src="/Tools/Js/removeLoading.js"></script>
    @include('sweetalert::alert')
</body>

</html>