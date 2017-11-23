<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}" />
  <title>@yield('title')</title>

  @section('styles')
  <link rel="stylesheet" type="text/css" href="{{url('assets/cheekycamel/css/bootstrap.min.css')}}" media="all">
  <link rel="stylesheet" type="text/css" href="{{url('assets/cheekycamel/css/font-awesome.css')}}" media="all">
  <link rel="stylesheet" type="text/css" href="{{url('assets/cheekycamel/css/bootsnav.css')}}" media="all">
  <link rel="stylesheet" type="text/css" href="{{url('assets/cheekycamel/css/slider-pro.min.css')}}" media="all">
  <link rel="stylesheet" type="text/css" href="{{url('assets/cheekycamel/css/stylesheet.css')}}" media="all">

  <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel="stylesheet">
  @show



</head>

<body>

  @yield('content')


  @section('scripts')
  <script type="text/javascript" src="{{url('assets/cheekycamel/js/jquery-2.1.0.min.js')}}"></script>
  <script type="text/javascript" src="{{url('assets/cheekycamel/js/price.js')}}"></script>
  <script src="{{url('assets/cheekycamel/js/jquery.nice-select.min.js')}}"></script> 
  
  <script type="text/javascript" src="{{url('assets/cheekycamel/js/bootstrap.min.js')}}"></script>
  

  <script type="text/javascript" src="{{url('assets/cheekycamel/js/bootsnav.js')}}"></script>

<script>
  $(document).ready(function() {
    $('select:not(.ignore)').niceSelect();      
  });    
</script>

 
<script>
  $('.form__field input').focusout(function () {
    if (!$(this).val().length == '') {
      $(this).addClass('filled');
    } else if ($(this).val.length == '') {
      $(this).removeClass('filled');
    }
  });
  $('.form__field textarea').focusout(function () {
    if (!$(this).val().length == '') {
      $(this).addClass('filled');
    } else if ($(this).val.length == '') {
      $(this).removeClass('filled');
    }
  });
</script>

@show


</body>
</html>
