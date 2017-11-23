@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

@include('layouts.partials.header')


@if(Session::has('failure'))
<h4 style="color:red;text-align: center;">{{Session::get('failure')}}</h4>
@elseif(Session::has('success'))
<h4 style="color:#efa52e;text-align: center;">{{Session::get('success')}}</h4>
@endif

@if(Session::has('log_fail'))
<h4 style="color:red;text-align: center;">{{Session::get('log_fail')}}</h4>
@endif


@if(Session::has('email_exist'))
<h4 style="color:red;text-align: center;">{{Session::get('email_exist')}}</h4>
@elseif(Session::has('subscribed_success'))
<h4 style="color:#efa52e;text-align: center;">{{Session::get('subscribed_success')}}</h4>
@elseif(Session::has('subscribe_failed'))
<h4 style="color:red;text-align: center;">{{Session::get('subscribe_failed')}}</h4>
@endif



<div class="slider">
  <div class="container">
    <div id="example1" class="slider-pro">
      <div class="sp-slides">

        @foreach($gifts as $gift)
        <div class="sp-slide">
          <img class="sp-image sp-lft" src="{{url('assets/cheekycamel/images/blank.gif')}}"
          data-src="{{url('uploads/gifts/'.$gift->image)}}"
          data-retina="{{url('uploads/gifts/'.$gift->image)}}"/>

          <h2 class="sp-layer sp-padding"
          data-position="topCenter" data-horizontal="150" data-vertical="155"
          data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="200" style="margin-left:-25px;">
          {{$gift->title}}
        </h2>

        <h4 class="sp-layer sp-padding hide-small-screen"
        data-position="centerCenter" data-horizontal="0" data-vertical="-155"
        data-show-transition="left" data-hide-transition="up" data-show-delay="600" data-hide-delay="100">
        {{$gift->category()->first()->category}}
      </h4>


    </div>
    @endforeach



  </div>

  <div class="sp-thumbnails">

    @foreach($gifts as $gift)

    <div class="sp-thumbnail">
      <div class="sp-thumbnail-img">
        <img src="{{url('uploads/gifts/'.$gift->image)}}" width="110" height="158">
      </div>
      <div class="sp-thumbnail-title">{{str_limit($gift->title,21)}}</div>
      <div class="sp-thumbnail-description">{{$gift->category()->first()->category}}</div>
    </div>
    @endforeach

  </div>

</div>
</div>
</div>

<div class="sec1 clearfix">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="col-md-8 no-padding">
     <div class="vide-sec">
      <div class="tabs">
        <div class="tab">
          <div class="tab-toggle">
            <h2>Batman dark Hot Toys </h2>
            <p>Lorem Ipsum is simply dummy text...</p>
          </div>
        </div>
        <div class="content">

          <div class="videoWrapper videoWrapper169 js-videoWrapper">
            <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowTransparency="true" allowfullscreen data-src="https://www.youtube.com/embed/j-2EtAvAFTc?autoplay=1"></iframe>
            <button class="videoPoster js-videoPoster" style="background-image:url({{url('assets/cheekycamel/images/video-poster.png')}});">Play video</button>
          </div>

        </div>
        <div class="tab">
          <div class="tab-toggle toggle1">
            <h2>Batman dark Hot Toys </h2>
            <p>Lorem Ipsum is simply dummy text...</p>
          </div>
        </div>
        <div class="content">
          <div class="videoWrapper videoWrapper169 js-videoWrapper">
            <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowTransparency="true" allowfullscreen data-src="https://www.youtube.com/embed/YQYf59s_Ae4?autoplay=1"></iframe>
            <button class="videoPoster js-videoPoster" style="background-image:url({{url('assets/cheekycamel/images/video-poster.png')}});">Play video</button>
          </div>
        </div>


      </div>
    </div>
  </div>

  <div class="col-md-4 no-padding">
   <div class="lst-pst clearfix">
    <h5 class="line">
      <span>Latest </span> Products
      <div class="navbar">
        <a id="next1" class="next" href="#"><span></span></a> 
        <a id="prev1" class="prev" href="#"><span></span></a>
      </div>
    </h5>

    <div class="outertight m-r-no">
      <ul class="block" id="carousel">


        @foreach($items as $item)

        <li>
          <div class="blk-img"><img src="{{url('uploads/shops/'.$item->images()->first()->images)}}" height="87"></div>
          <div class="blk-txt">
            <h4><a href="{{url('/details/'.str_slug($item->slug))}}">{{$item->title}}</a></h4>
            <p>{{str_limit($item->description,50)}}</p>
            <div class="bg">{{$item->category()->first()->category}}</div>
            <div class="pp">{{$item->price}}qar</div>
          </div>
        </li>
        
        @endforeach


      </ul>
    </div>

  </div>
</div>

{{-- ##################################################### --}}

</div>
</div>
</div>

<div class="main-game">
  <div class="container">
    <div class="col-md-12 no-padding">

      <div class="row">
        <ul>

          @foreach($tabletops as $tabletop)
        
       
          <li><div class="product-hover"></div><a href="{{url('/details/'.str_slug($tabletop->slug))}}"><img src="{{url('uploads/shops/'.$tabletop->images()->first()->images)}}" class="img-responsive" style="min-width: 100%;"><h2>{{$tabletop->category->category}}</h2></a></li>

          @endforeach
 

        </ul>
      </div>
    </div>
  </div>
</div>

<div class="gift-box">
 <div class="container">
  <div class="col-md-12 no-padding">
   <div class="row">
    <div class="col-md-7">
     <h3><span>gift</span> Boxes</h3>
     <p>Lorem Ipsum is simply dummy text of the printing <br> and typesetting industry. </p>
     <div id="owl-demo1" class="owl-carousel clearfix">

      @foreach($gifts as $gift)

      <div class="item "><div class="gift-item">
       <div class="sp-thumbnail-img">
        <img src="{{url('uploads/gifts/'.$gift->image)}}"> 
      </div>
      <h2>{{str_limit($gift->title,21)}} <br> <span>{{$gift->category()->first()->category}} </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
      @endforeach


    </div>
  </div>

  <div class="col-md-5">
   <div class="glitch-image"></div>
   <canvas id="canvas"></canvas>
 </div>

</div>
</div>
</div>
</div>

<div class="count">
 <div class="container">
  <div class="col-md-12 no-padding">
   <div class="row">
    <div class="col-md-3 text-center col-xs-6">
     <div class="count-sec">
      <div class="counting"><div class="counter">763</div><h4>Collectibles</h4></div>
    </div>
  </div>

  <div class="col-md-3 text-center col-xs-6">
   <div class="count-sec">
    <div class="counting"><div class="counter">500</div><h4>Board Games</h4></div>
  </div>
</div>

<div class="col-md-3 text-center col-xs-6">
 <div class="count-sec">
  <div class="counting"><div class="counter">100</div><h4>Gamers</h4></div>
</div>
</div>

<div class="col-md-3 text-center col-xs-6">
 <div class="count-sec">
  <div class="counting"><div class="counter">900</div><h4>Customers</h4></div>
</div>
</div>

</div>
</div>
</div>
</div>

<div class="brands">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="">
     <div class="col-md-2 no-padding">
      <div class="brand-lf">
        <h1>Our <br> Brands</h1>
      </div>
    </div>

    <div class="col-md-10 padding-right-0">
      <div id="owl-demo" class="owl-carousel clearfix">

        @foreach($brands as $brand)
        <div class="item"><img src="{{url('uploads/brands/'.$brand->logo)}}"></div>
        @endforeach



      </div>
    </div>

  </div>
</div>
</div>
</div>


<!--<div id="large-header" class="large-header">
    <canvas id="demo-canvas"></canvas>
  </div>-->

  @include('layouts.partials.footer')
  @endsection


  @section('scripts')
  @parent

  <script type="text/javascript" src="{{url('assets/cheekycamel/js/carouFredSel.js')}}"></script>

  <script type="text/javascript">
    $(function() {
      var pgurl = window.location.href.substr(window.location.href
        .lastIndexOf("/")+1);
      $("#navbar-menu ul li").each(function(){
        if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $('a').removeClass('active');
        $("#home").addClass("active");
      })
    });
  </script>



  <script src="{{url('assets/cheekycamel/js/waypoints.min.js')}}"></script> 
  <script src="{{url('assets/cheekycamel/js/jquery.counterup.min.js')}}"></script> 
  <script src="{{url('assets/cheekycamel/js/owl.carousel.js')}}"></script>
  <script>
    $(document).ready(function() {  
      $("#owl-demo").owlCarousel({
        autoPlay:5000,
        items : 6,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        navigation : true,
      });
      $( ".owl-prev").html('<img src="{{url('assets/cheekycamel/images/brand-lft.png')}}">');
      $( ".owl-next").html('<img src="{{url('assets/cheekycamel/images/brand-rgt.png')}}">');
    });


    $(document).ready(function() {  
      $("#owl-demo1").owlCarousel({
        items : 3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        navigation : true,
      });
      $( ".owl-prev").html('<img src="{{url('assets/cheekycamel/images/gift/pre.png')}}">');
      $( ".owl-next").html('<img src="{{url('assets/cheekycamel/images/gift/nxt.png')}}">');
    });


    jQuery(document).ready(function( $ ) {
      $('.counter').counterUp({
        delay: 10,
        time: 3000
      });
    });

  </script>

  <script type="text/javascript" src="{{url('assets/cheekycamel/js/carouFredSel.js')}}"></script>
  <script>
    jQuery(function() {
      jQuery('#carousel').carouFredSel({
        width: '100%',
        direction   : "up",
        scroll : 300,
        items: {
          visible: '+4'
        },
        auto: {
          items: 1,
          timeoutDuration : 4000
        },
        prev: {
          button: '#prev1',
          items: 1
        },    
        next: {
          button: '#next1',
          items: 1
        }
      });
    });
  </script>
  <script>
    wrapper = $('.tabs');
    tabs = wrapper.find('.tab');
    tabToggle = wrapper.find('.tab-toggle');
    function openTab() {
      var content = $(this).parent().next('.content'), activeItems = wrapper.find('.active');
      if (!$(this).hasClass('active')) {
        $(this).add(content).add(activeItems).toggleClass('active');
        wrapper.css('min-height', content.outerHeight());
      }
    }
    ;
    tabToggle.on('click', openTab);
    $(window).load(function () {
      tabToggle.first().trigger('click');
    });

  </script>
  <script>$(document).on('click', '.js-videoPoster', function (ev) {
    ev.preventDefault();
    var $poster = $(this);
    var $wrapper = $poster.closest('.js-videoWrapper');
    videoPlay($wrapper);
  });
  function videoPlay($wrapper) {
    var $iframe = $wrapper.find('.js-videoIframe');
    var src = $iframe.data('src');
    $wrapper.addClass('videoWrapperActive');
    $iframe.attr('src', src);
  }
  function videoStop($wrapper) {
    if (!$wrapper) {
      var $wrapper = $('.js-videoWrapper');
      var $iframe = $('.js-videoIframe');
    } else {
      var $iframe = $wrapper.find('.js-videoIframe');
    }
    $wrapper.removeClass('videoWrapperActive');
    $iframe.attr('src', '');
  }
</script>
<script type="text/javascript" src="{{url('assets/cheekycamel/js/jquery.sliderPro.min.js')}}"></script>
<script type="text/javascript">
  $( document ).ready(function( $ ) {
    $( '#example1' ).sliderPro({
      width: 1170,
      height: 680,
      arrows: true,
      buttons: false,
      waitForLayers: true,
      thumbnailWidth: 210,
      thumbnailHeight: 100,
      thumbnailPointer: true,
      autoplay: true,
      autoScaleLayers: false,
      breakpoints: {
        500: {
          thumbnailWidth: 120,
          thumbnailHeight: 50
        }
      }
    });
  });
</script>
<script type="text/javascript" src="{{url('assets/cheekycamel/js/index.js')}}"></script>
<script src="{{url('assets/cheekycamel/js/demo-2.js')}}"></script>

@endsection
