
@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

@include('layouts.partials.header')


<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="abt-hd">
    <h2>APPARELS</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>Apparels</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>



<div class="pdct-detail">

  <div class="container">
    <div class="col-md-12 no-padding pdct-bg">

     <div class="col-md-5">
       <section class="slider">

        <div id="slider" class="flexslider">
          <ul class="slides">
            @foreach($apparels->images as $item)
            <li id="picture-frame"><img src="{{url('uploads/apparels/'.$item->images)}}" data-src="{{url('uploads/apparels/'.$item->images)}}"  /></li>

            {{--  <li><img src="{{url('uploads/shops/'.$item->images)}}" /></li> --}}
            @endforeach
            
          </ul>

        </div>

        <div id="carousel" class="flexslider">

          <ul class="slides flex-control-thumbs">

            @foreach($apparels->images as $item) 

            <li><img src="{{url('uploads/apparels/'.$item->images)}}" /></li>
            @endforeach

            
          </ul>
        </div>

        
      </section>
    </div>


    {{--   @foreach($items as $items) --}}
    {{-- {{dd($items)}} --}}
    <div class="col-md-7">
     <div class="pdct-txt">
      <div class="pdct-ttl">
        <h2>{{$apparels->title}}</h2>
        <h6>ONLY {{$apparels->quantity}} LEFT IN STOCK</h6>
      </div>

      <div class="pr-sec clearfix">
       <div class="col-md-6 no-padding"><h2>QAR <label id="total-{{$apparels->id}}">{{ $apparels->price}}</label></h2></div>
       <div class="col-md-6 no-padding">
         <div class="input-group quantity">
          <span class="input-group-btn">

            <button type="button" class="btn btn-minus btn-number" disabled="disabled" data-type="minus" data-field="quant[{{$apparels->id}}]">
              <span class="fa fa-minus"></span>
            </button>

          </span>

          

          <input type="text" name="quant[{{$apparels->id}}]" class="input-number number" value="{{@$carts != ""?@$carts->quantity:1}}" min="1" max="30" data-id="{{$apparels->id}}" data-price="{{$apparels->price}}">

          <span class="input-group-btn">

            <button type="button" class="btn btn-plus btn-number" data-type="plus" data-field="quant[{{$apparels->id}}]">
              <span class="fa fa-plus"></span>
            </button>

          </span>
        </div>
      </div>
    </div>

    <div class="pdct-social">
      <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&mobile_iframe=true&width=58&height=20&appId" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div>

    <div class="pdct-con">
      <p>{{$apparels->description}}</p>

      {{-- <p>You can now assemble a giant paper puzzle of Kings Landing from popular series of Game of Thrones. Situated on the east coast of Westeros, overlooking Blackwater Bay, it is the capital of the Seven Kingdoms. Within the citys Red Keep stands the formidable Iron Throne from which the king rules.</p> --}}

    </div>

    <div class="add-btn">
     {{-- <a href="#" class="atw">Add to wishlist</a> --}}
     @if($apparels->quantity < 1)
     <a href="#" class="atc" ><span>Out of stock</span></a>
     @elseif($apparels->quantity >= 1)

     @if(@$carts->quantity != null || @$carts->quantity>0))
      <a href="#" class="atc" onclick="cart.addToCart({{$apparels->id}} )"><span>Update cart</span></a>
     
     @elseif(@$carts->quantity == null )
       <a href="#" class="atc" onclick="cart.addToCart({{$apparels->id}} )"><span>Add to cart</span></a>
     @endif
    
     @endif

   </div>

 </div>
</div>

{{-- @endforeach --}}

</div>
</div>
</div>






@include('layouts.partials.footer')

@endsection

@section('scripts')
@parent

<script src="{{url('assets/cheekycamel/js/jquery.flexslider.js')}}"></script>
<script type="text/javascript">
  $(window).load(function(){
    $('#carousel').flexslider({
     animation: "slide",
     controlNav: false,
     animationLoop: false,
     slideshow: true,
     itemWidth: 80,
     itemMargin: 5,
     asNavFor: '#slider'
   });

    $('#slider').flexslider({
     animation: "slide",
     controlNav: false,
     animationLoop: false,
     slideshow: true,
     sync: "#carousel",
     start: function(slider){
       $('body').removeClass('loading');
     }
   });
  });

  $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if(type == 'minus') {

        if(currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        } 
        if(parseInt(input.val()) == input.attr('min')) {
          $(this).attr('disabled', true);
        }

      } else if(type == 'plus') {

        if(currentVal < input.attr('max')) {
          input.val(currentVal + 1).change();
        }
        if(parseInt(input.val()) == input.attr('max')) {
          $(this).attr('disabled', true);
        }

      }
    } else {
      input.val(0);
    }
  });
  $('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
 });
  $('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    
    
  });


  var cart ={};
  cart.addToCart = function(id)
  {
   
    $.ajax({

      url:"{{url('apparel/add-to-cart')}}",
      type:'POST',
      data:{id:id,currentVal:valueCurrent},

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
  $(function() {
    var pgurl = window.location.href.substr(window.location.href
      .lastIndexOf("/")+1);
    $("#navbar-menu ul li").each(function(){
      if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
        $('a').removeClass('active');
      $("#apparels").addClass("active");
    })
  });
</script>



<script type="text/javascript">
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
  });

</script>

@endsection
