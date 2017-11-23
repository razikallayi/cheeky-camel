@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

@include('layouts.partials.header')


@if(Session::has('failure'))
<h4 style="color:red;text-align: center;">{{Session::get('failure')}}</h4>
@elseif(Session::has('success'))
<h4 style="color:#efa52e;text-align: center;">{{Session::get('success')}}</h4>
@endif





<div class="slider">
  <div class="container">
    <div id="example1" class="slider-pro">
		<div class="sp-slides">
			<div class="sp-slide">
				<img class="sp-image sp-lft" src="{{url('assets/cheekycamel/images/blank.gif')}}"
					data-src="{{url('assets/cheekycamel/images/slider/slider1.png')}}"
					data-retina="{{url('assets/cheekycamel/images/slider/slider1.png')}}"/>
				
				<h2 class="sp-layer sp-padding"
					data-position="topCenter" data-horizontal="150" data-vertical="155"
					data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="200">
					Batman Dark
				</h2>

				<h4 class="sp-layer sp-padding hide-small-screen"
					data-position="centerCenter" data-horizontal="0" data-vertical="-155"
					data-show-transition="left" data-hide-transition="up" data-show-delay="600" data-hide-delay="100">
					Hot Toys
				</h4>

				
			</div>

	        <div class="sp-slide">
	        	<img class="sp-image sp-lft" src="{{url('assets/cheekycamel/images/blank.gif')}}"
	        		data-src="{{url('assets/cheekycamel/images/slider/slider1.png')}}"
	        		data-retina="{{url('assets/cheekycamel/images/slider/slider1.png')}}"/>

				<h2 class="sp-layer sp-padding"
					data-position="topCenter" data-horizontal="150" data-vertical="155"
					data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="200">
					Batman Dark
				</h2>

				<h4 class="sp-layer sp-padding hide-small-screen"
					data-position="centerCenter" data-horizontal="0" data-vertical="-155"
					data-show-transition="left" data-hide-transition="up" data-show-delay="600" data-hide-delay="100">
					Hot Toys
				</h4>
			</div>

			<div class="sp-slide">
				<img class="sp-image sp-lft" src="{{url('assets/cheekycamel/images/blank.gif')}}"
					data-src="{{url('assets/cheekycamel/images/slider/slider1.png')}}"
					data-retina="{{url('assets/cheekycamel/images/slider/slider1.png')}}"/>

				<h2 class="sp-layer sp-padding"
					data-position="topCenter" data-horizontal="150" data-vertical="155"
					data-show-transition="left" data-hide-transition="up" data-show-delay="400" data-hide-delay="200">
					Batman Dark
				</h2>

				<h4 class="sp-layer sp-padding hide-small-screen"
					data-position="centerCenter" data-horizontal="0" data-vertical="-155"
					data-show-transition="left" data-hide-transition="up" data-show-delay="600" data-hide-delay="100">
					Hot Toys
				</h4>
			</div>
			
		</div>

		<div class="sp-thumbnails">
			<div class="sp-thumbnail">
            <img src="{{url('assets/cheekycamel/images/gift/gift1.png')}}">
				<div class="sp-thumbnail-title">Super Man</div>
				<div class="sp-thumbnail-description">Hot Toys</div>
			</div>

			<div class="sp-thumbnail">
            <img src="{{url('assets/cheekycamel/images/gift/gift2.png')}}">
				<div class="sp-thumbnail-title">Super Man</div>
				<div class="sp-thumbnail-description">Hot Toys</div>
			</div>

			<div class="sp-thumbnail">
            <img src="{{url('assets/cheekycamel/images/gift/gift3.png')}}">
				<div class="sp-thumbnail-title">Super Man</div>
				<div class="sp-thumbnail-description">Hot Toys</div>
			</div>
			
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
    <button class="videoPoster js-videoPoster" style="background-image:url({{url('assets/cheekycamel/images/video-poster.png')}};">Play video</button>
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
    <button class="videoPoster js-videoPoster" style="background-image:url(images/video-poster.png);">Play video</button>
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
                                <li>
                                    <div class="blk-img"><img src="{{url('assets/cheekycamel/images/lp1.jpg')}}"></div>
                                    <div class="blk-txt">
                                       <h4><a href="#">Disco Iron Man</a></h4>
                                       <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                       <div class="bg">Board Game</div>
                                       <div class="pp">120 qar</div>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="blk-img"><img src="{{url('assets/cheekycamel/images/lp2.jpg')}}"></div>
                                    <div class="blk-txt">
                                       <h4><a href="#">Disco Iron Man</a></h4>
                                       <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                       <div class="bg">Board Game</div>
                                       <div class="pp">120 qar</div>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="blk-img"><img src="{{url('assets/cheekycamel/images/lp3.jpg')}}"></div>
                                    <div class="blk-txt">
                                       <h4><a href="#">Disco Iron Man</a></h4>
                                       <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                       <div class="bg">Board Game</div>
                                       <div class="pp">120 qar</div>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="blk-img"><img src="{{url('assets/cheekycamel/images/lp4.jpg')}}"></div>
                                    <div class="blk-txt">
                                       <h4><a href="#">Disco Iron Man</a></h4>
                                       <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                       <div class="bg">Board Game</div>
                                       <div class="pp">120 qar</div>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="blk-img"><img src="{{url('assets/cheekycamel/images/lp1.jpg')}}"></div>
                                    <div class="blk-txt">
                                       <h4><a href="#">Disco Iron Man</a></h4>
                                       <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                       <div class="bg">Board Game</div>
                                       <div class="pp">120 qar</div>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
           
           </div>
        </div>
     </div>
  </div>
</div>

<div class="main-game">
  <div class="container">
    <div class="col-md-12 no-padding">
      <div class="row">
        <ul>
          <li><div class="product-hover"></div><a href="#"><img src="{{url('assets/cheekycamel/images/game-type1.jpg')}}" class="img-responsive"><h2>Board Game</h2></a></li>
          <li><div class="product-hover"></div><a href="#"><img src="{{url('assets/cheekycamel/images/game-type2.jpg')}}" class="img-responsive"><h2>card Game</h2></a></li>
          <li><div class="product-hover"></div><a href="#"><img src="{{url('assets/cheekycamel/images/game-type3.jpg')}}" class="img-responsive"><h2>dice Game</h2></a></li>
          <li><div class="product-hover"></div><a href="#"><img src="{{url('assets/cheekycamel/images/game-type4.jpg')}}" class="img-responsive"><h2>tile Game</h2></a></li>
          <li><div class="product-hover"></div><a href="#"><img src="{{url('assets/cheekycamel/images/game-type5.jpg')}}" class="img-responsive"><h2>Miniatures Game</h2></a></li>
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
                <div class="item "><div class="gift-item"><img src="{{url('assets/cheekycamel/images/gift/gift1.png')}}"> <h2>Iron Man <br> <span>Hot Toys </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
                <div class="item "><div class="gift-item"><img src="{{url('assets/cheekycamel/images/gift/gift2.png')}}"> <h2>Iron Man <br> <span>Hot Toys </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
                <div class="item "><div class="gift-item"><img src="{{url('assets/cheekycamel/images/gift/gift3.png')}}"> <h2>Iron Man <br> <span>Hot Toys </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
                <div class="item "><div class="gift-item"><img src="{{url('assets/cheekycamel/images/gift/gift1.png')}}"> <h2>Iron Man <br> <span>Hot Toys </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
                <div class="item "><div class="gift-item"><img src="{{url('assets/cheekycamel/images/gift/gift2.png')}}"> <h2>Iron Man <br> <span>Hot Toys </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
                <div class="item "><div class="gift-item"><img src="{{url('assets/cheekycamel/images/gift/gift3.png')}}"> <h2>Iron Man <br> <span>Hot Toys </span> </h2> <a href="#"><img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div></div>
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
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/1.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/2.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/3.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/4.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/5.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/6.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/1.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/2.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/3.jpg')}}"></div>
                <div class="item"><img src="{{url('assets/cheekycamel/images/brand/4.jpg')}}"></div>
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
@endsection
