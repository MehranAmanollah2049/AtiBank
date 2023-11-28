<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Tools/Css/styleAll.css">
    <link rel="stylesheet" href="/admin/dist/css/logInPage.css">
    <title>صفحه ورود به پنل ادمین</title>
</head>

<body>

    <!-- particles.js container -->
    <div id="particles-js"></div>


    <div class="container">
        <form action="/LogInAdmin" method="post">
            <p class="title">ورود به پنل</p>
            <div class="int">
                <input type="text" placeholder="admin" name="username" value="{{ old('username') }}">
                <label for="">نام کاربری</label>
            </div>
            <div class="int">
                <input type="text" placeholder="admin" name="password" value="{{ old('password') }}">
                <label for="">پسورد</label>
            </div>
            <p class="error">
                @if($errors->any())

                {{ $errors->first() }}

                @endif
            </p>
            <button type="submit">ورود به پنل</button>
            @csrf
        </form>
    </div>


    <script defer src="/Tools/Js/particles.js"></script>
    <script defer src="/Admin/dist/js/bgAnimation.js"></script>

    @include('sweetalert::alert')
</body>

</html>