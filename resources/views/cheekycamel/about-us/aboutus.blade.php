@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

@include('layouts.partials.header')


<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="abt-hd">
      <h2>About US</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>About us</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>


<div class="abt-sec">
  <div class="container">
   <div class="col-md-12 no-padding">
     <div class="videoWrapper videoWrapper169 js-videoWrapper">
      <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowTransparency="true" allowfullscreen data-src="https://www.youtube.com/embed/YQYf59s_Ae4?autoplay=1"></iframe>
      <button class="videoPoster js-videoPoster" style="background-image:url({{url('assets/cheekycamel/images/abt-sec-vid.jpg')}});">Play video</button>
    </div>
  </div>
  
  <div class="col-md-12 no-padding">
   <div class="wwa">
    <div class="row">
     <div class="col-md-3"><h2>Who <br> we are</h2></div>
     <div class="col-md-8"><p>Back to Games is the UAE’s first retail shop that specialises in the sale of a vast amount of modern board and card games.  We proudly offer a wide variety of North American and European tabletop games embracing various themes. You will enjoy countless hours of excitement and fun with family and friends of all ages while playing one or more of our exceptional products. Our passion is to develop and expand a sustainable and entertaining tabletop gaming culture in the UAE. In store, a welcoming and enthusiastic team will be at the forefront, guiding you on your captivating journey into the world of tabletop gaming.</p></div>
   </div>
 </div>
</div>

{{--
<div class="col-md-12 no-padding">
 <div class="tm">
  <h2>Our Team</h2>
  <div class="row">
   <div class="col-md-3">
    <figure class="tme">
      <img src="{{url('assets/cheekycamel/images/team1.jpg')}}" />
      <figcaption>
        <div>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <h2>NAme  <span>Goes Here</span> </h2>  
      </figcaption>     
    </figure>
  </div>
  
  <div class="col-md-3">
    <figure class="tme">
      <img src="{{url('assets/cheekycamel/images/team1.jpg')}}" />
      <figcaption>
        <div>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <h2>NAme  <span>Goes Here</span> </h2>  
      </figcaption>     
    </figure>
  </div>
  
  <div class="col-md-3">
    <figure class="tme">
      <img src="{{url('assets/cheekycamel/images/team1.jpg')}}" />
      <figcaption>
        <div>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <h2>NAme  <span>Goes Here</span> </h2>  
      </figcaption>     
    </figure>
  </div>
  
  <div class="col-md-3">
    <figure class="tme">
      <img src="{{url('assets/cheekycamel/images/team1.jpg')}}" />
      <figcaption>
        <div>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
        <h2>NAme  <span>Goes Here</span> </h2>  
      </figcaption>     
    </figure>
  </div>
  
</div>
</div>
</div>

--}}
</div>
</div>


@include('layouts.partials.footer')

@endsection


@section('scripts')
@parent
<script type="text/javascript">
  $(function() {
    var pgurl = window.location.href.substr(window.location.href
      .lastIndexOf("/")+1);
    $("#navbar-menu ul li").each(function(){
      if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
        $('a').removeClass('active');
      $("#about").addClass("active");
    })
  });
</script>



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
    $( ".owl-prev").html('<img src="images/brand-lft.png">');
    $( ".owl-next").html('<img src="images/brand-rgt.png">');
  });


  $(document).ready(function() {  
    $("#owl-demo1").owlCarousel({
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      navigation : true,
    });
    $( ".owl-prev").html('<img src="images/gift/pre.png">');
    $( ".owl-next").html('<img src="images/gift/nxt.png">');
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
@endsection





