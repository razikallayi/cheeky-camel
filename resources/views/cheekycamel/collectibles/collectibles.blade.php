@extends('layouts.cheeky-camel-master')

@section('title','Cheeky Camel')
@section('content')
@include('layouts.partials.header')


<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="abt-hd">
      <h2>TableTop</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>TableTop</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>



<div class="aprls">
  <div class="container">
   <div class="col-md-12 no-padding ap-bg">
    <div class="col-md-3 no-padding">
     <div class="aprls-lft">
      <h2>Games Categories</h2>
      <div class="cate clearfix">
       <ul>
     @if($shops)
        @foreach($shops as $shop)
         <li class="clearfix">
          <a href="{{url('/tabletop/'.str_slug($shop->category->category))}}">
           <div class="cate-img"><img src="{{url('uploads/shops/'.$shop->images()->first()->images)}}"></div>
           <div class="cate-txt"><h4>{{$shop->category->category}}</h4><img src="{{url('assets/cheekycamel/images/gift/nxt.png')}}"></div>
         </a>
       </li>
       @endforeach
      @endif
    
       
     </ul>
   </div>
  <form method="post"  id="formid" enctype="multipart/form-data">
     {{csrf_field()}}
     <h2>Filter by Price</h2>
     <input type="hidden" name="table" value="{{App\Models\Shop::TABLE}}">

     <div class="price-range">
      <section class="range-slider" id="facet-price-range-slider" 
      data-options='{"output":{"prefix":"QAR"},"maxSymbol":""}'>
        <input name="range1" value="0" min="0" max="1250" step="1" type="range" onchange="ajaxChangeConsole();">
        <input name="range2" value="1250" min="0" max="1250" step="1" type="range" onchange="ajaxChangeConsole();">
      </section>
    </div>

    <h2>Filter by Theme</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="theme" onchange="ajaxChangeConsole();">
        <option value="">Any Game Themes</option>
        @foreach($themes as $theme)
        <option value="{{$theme->theme}}">{{$theme->theme}}</option>
        @endforeach
      </select>
    </div>

    <h2>Filter by Mechanic</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="mechanic" onchange="ajaxChangeConsole();">
        <option value="">Any Game Mechanics</option>
        @foreach($mechanics as $mechanic)
        <option value="{{$mechanic->mechanic}}">{{$mechanic->mechanic}}</option>
        @endforeach
      </select>
    </div>

    <h2>Filter by Product Type</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="category" onchange="ajaxChangeConsole();">
        <option value="">Any Product</option>
        @foreach($types as $type)
        <option value="{{$type->category_id}}">{{$type->category->category}}</option>
        @endforeach
      </select>
    </div>

    <h2>Filter by Minimum Age</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="minage" onchange="ajaxChangeConsole();">
        <option value="">Any Minimum Age</option>
        @foreach($ages as $age)
        <option value="{{$age->minimum_age}}">{{$age->minimum_age}}</option>
        @endforeach
      </select>
    </div>

    <h2>Filter by Minimum Players</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="players" onchange="ajaxChangeConsole();">
        <option value="">Any Minimum Players</option>
        @foreach($players as $player)
        <option value="{{$player->minimum_players}}">{{$player->minimum_players}}</option>
        @endforeach
      </select>
    </div>

    <h2>Filter by Playing Time</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="time" onchange="ajaxChangeConsole();">
        <option value="">Any Playing Time</option>
        @foreach($times as $time)
        <option value="{{$time->playing_time}}">{{$time->playing_time}}</option>
        @endforeach
      </select>
    </div>

    <h2>Filter by Publisher</h2>

    <div class="fl clearfix">
      <select class="wide clearfix" name="publisher" onchange="ajaxChangeConsole();">
        <option value="">Any Publisher</option>
        @foreach($publishers as $publisher)
        <option value="{{$publisher->publisher}}">{{$publisher->publisher}}</option>
        @endforeach
      </select>
    </div>

   

</form>

</div>
</div>
<div class="col-md-9 no-padding">

  <div class="aprls-sec clearfix" id="main-div-collectibles">



    @foreach($tabletops as $tabletop)

@php
$cartId = $tabletop->id ."-". 'shops';
$carts = Cart::get($cartId);

@endphp

    <div class="col-md-4">
      <div class="grid">
        <figure class="effect-shop" style="min-width: 100%;">

          <a href="{{url('/details/'.$tabletop->slug)}}"><img src="{{url('uploads/shops/'.$tabletop->images()->first()->images)}}" style="min-width: 100%;" /></a>

          <figcaption>

            <div class="aprl-txt"><div class="col-md-6 no-padding ac">
              @if($tabletop->quantity < 1)
              <a href="#">Out of stock</a>
              @else
              @if(@$carts->quantity == null || @$carts->quantity == " ")
              <a href="#"  onclick="cart.addToCart({{$tabletop->id}} )" >Add to cart</a>
              @else
              <a href="#"  onclick="cart.addToCart({{$tabletop->id}} )" >Update cart</a>
              @endif
              @endif
            </div><div class="col-md-6 no-padding p">QAR {{$tabletop->price}}</div></div>

          </figcaption>
        </figure>
        <h2><a href="{{url('/details/'.$tabletop->slug)}}">{{$tabletop->title}}</a></h2>
      </div>
    </div>
    @endforeach

  </div>

</div>
</div>
</div>
</div>
@include('layouts.partials.footer')

@endsection

@section('scripts')
@parent
<script type="text/javascript">
  jQuery(function() {
    var pgurl = window.location.href.substr(window.location.href
      .lastIndexOf("/")+1);
    jQuery("#navbar-menu ul li").each(function(){
      if(jQuery(this).attr("href") == pgurl || jQuery(this).attr("href") == '' )
        jQuery('a').removeClass('active');
      jQuery("#collectibles").addClass("active");
    })
  });
</script>

<script type="text/javascript">
  var cart ={};
  cart.addToCart = function(id)
  {

    $.ajax({

      url:"{{url('add-to-cart')}}",
      type:'POST',
      data:{id:id},

      success:function(data)
      {
        $('#cartCount').stop().html(function (_, oldText) {
        }).animate(10);


         // $('#cartCount').css("animation","zoomout 5s ease-in-out 2s 1 alternate");
         $('#cartCount').html(data.cartCount);
         
       },

       error:function()
       {
        alert('Adding to cart failed');
      }

    });
  }

</script>


<script type="text/javascript">
  function ajaxChangeConsole()
  {

    $('#formid').submit();
  }


  //--------------------------------


  $('#formid').submit(function(e){
    e.preventDefault();

 var formData = new FormData(this);   

  $.ajax({

      url:"{{url('select-theme')}}",
      type:'POST',
      data:formData,
      dataType:'json',
      encode:true,
      processData:false,
      contentType:false,

      success:function(data)
      {
        var div = $('#main-div-collectibles');

        div.html("");

      $.each(data,function(index,shop){
        div.append('<div class="col-md-4"> <div class="grid"> <figure class="effect-shop" style="min-width: 100%;"><a href="{{url('details')}}'+"/"+shop.slug+'"><img src="{{App\Models\ShopImage::IMAGE_LOCATION."/"}}'+shop.images[0].images+'" style="min-width: 100%;" /></a><figcaption><div class="aprl-txt"> <div class="col-md-6 no-padding ac"><a href="#" >Add to cart</a></div><div class="col-md-6 no-padding p">QAR '+shop.price+'</div></div></figcaption></figure><h2><a href="{{url('details')}}'+"/"+shop.slug+'">'+shop.title+'</a></h2></div></div>');
      });

      },
      error:function()
      {

      }

    });

  });
</script>

<script type="text/javascript">
//Used for all Ajax posts
// CSRF protection
$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>

@endsection

