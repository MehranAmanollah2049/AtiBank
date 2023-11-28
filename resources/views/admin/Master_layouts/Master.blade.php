<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Tools/Css/styleAll.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin/dist/css/bootstrap-theme.css">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="/admin/dist/css/rtl.css">
    <!-- persian Date Picker -->
    <link rel="stylesheet" href="/admin/dist/css/persian-datepicker-0.4.5.min">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">

    @yield("css_links")

    <title>پنل ادمین - @yield('page_title')</title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- header -->
        @include("admin.Master_layouts.Header")


        <!-- sidebar -->
        @include("admin.Master_layouts.Menu_sideBar")


        <div class="content-wrapper">
            @yield("Main_content")
        </div>

        <!-- footer -->
        @include("admin.Master_layouts.Footer")


    </div>


    <!-- jQuery 3 -->
    <script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   
    <!-- Bootstrap 3.3.7 -->
    <script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="/admin/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="/Tools/Js/CheckDelete.js"></script>
    
    @yield("js_links")
    
    
    @include('sweetalert::alert')
</body>

</html>