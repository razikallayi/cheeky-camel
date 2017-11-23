<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{url('md/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{url('assets/admin/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{url('assets/admin/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{url('assets/admin/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{url('assets/admin/css/style.css')}}" rel="stylesheet">
</head>





<body class="login-page" >
    <div class="login-box">
        {{-- <div class="logo">

            <a href="{{ url(config('whyte.project.link')) }}"><img src="{{ url(config('whyte.project.logo')) }}"></a>
            <small>{{ config('whyte.project.subname') }}</small>
        </div> --}}
        
        @yield('content')

        <footer class="text-center">
            <a class="col-amber" target="_blank" href="{{ url(config('whyte.admin.copyright_link'))}}">{{config('whyte.admin.copyright')}}</a>
        </footer>

    </div>


    @section('scripts')
    <!-- Jquery Core Js -->
    <script src="{{url('assets/admin/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{url('assets/admin/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{url('assets/admin/plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{url('assets/admin/plugins/jquery-validation/jquery.validate.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{url('assets/admin/js/admin.js')}}"></script>
    @show
</body>

</html>