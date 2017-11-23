@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')
<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0; 
    }




    /*POPUP*/

.dialog,
.dialog__overlay {
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
      z-index: 1111;
}

.dialog {
  position: fixed;
  display: -webkit-flex;
  display: flex;
  -webkit-align-items: center;
  align-items: center;
  -webkit-justify-content: center;
  justify-content: center;
  pointer-events: none;
}

.dialog__overlay {
  position: absolute;
  z-index: 1;
  background: rgba(0, 0, 0, 0.9);
  opacity: 0;
  -webkit-transition: opacity 0.3s;
  transition: opacity 0.3s;
  -webkit-backface-visibility: hidden;
}

.dialog--open .dialog__overlay {
  opacity: 1;
  pointer-events: auto;
}

.dialog__content {
  width: 50%;
  max-width: 560px;
  min-width: 290px;
  background: #3c2b2b;
  padding: 2em;
  text-align: center;
  position: relative;
  z-index: 5;
  opacity: 0;
  border-radius:5px
}

.dialog--open .dialog__content {
  pointer-events: auto;
}

/* Content */
.dialog h2 {
  margin: 0;
  font-weight: 400;
  font-size: 31px;
  padding: 0 0 0;
  margin: 0;
  color:#ebebeb;
  text-transform:uppercase;
  margin-top: -40px;
  letter-spacing:0.5px
}
.dialog p{color:#ebebeb; font-size:13px}

.dialog__overlay {
  -webkit-transition-duration: 0.4s;
  transition-duration: 0.4s;
}

/*.dialog__content {
  overflow: hidden;
}*/

.dialog.dialog--open .dialog__content,
.dialog.dialog--close .dialog__content {
  -webkit-animation-duration: 0.4s;
  animation-duration: 0.4s;
  -webkit-animation-timing-function: cubic-bezier(0.7,0,0.3,1);
  animation-timing-function: cubic-bezier(0.7,0,0.3,1);
  -webkit-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
  -webkit-transform-origin: -150% 50%;
  transform-origin: -150% 50%;
}

.dialog.dialog--open .dialog__content {
  -webkit-animation-name: anim-open;
  animation-name: anim-open;
}

.dialog.dialog--close .dialog__content {
  -webkit-animation-name: anim-close;
  animation-name: anim-close;
}

.dialog.dialog--open h2,
.dialog.dialog--open button {
  bottom: -97px;
  -webkit-animation: anim-elem 0.4s both;
  animation: anim-elem 0.4s both;
  -webkit-transform-origin: -50% 50%;
  transform-origin: -50% 50%;
  -webkit-animation-timing-function: cubic-bezier(0.7,0,0.3,1);
  animation-timing-function: cubic-bezier(0.7,0,0.3,1);
}

.dialog.dialog--open h2 {
  -webkit-animation-delay: 0.15s;
  animation-delay: 0.15s;
}

.dialog.dialog--open button {
  -webkit-animation-delay: 0.1s;
  animation-delay: 0.1s;
}

@-webkit-keyframes anim-open {
  0% { opacity: 0; -webkit-transform: rotate3d(0, 0, 1, -45deg); }
  100% { opacity: 1; -webkit-transform: rotate3d(0, 0, 1, 0deg); }
}

@keyframes anim-open {
  0% { opacity: 0; -webkit-transform: rotate3d(0, 0, 1, -45deg); transform: rotate3d(0, 0, 1, -45deg); }
  100% { opacity: 1; -webkit-transform: rotate3d(0, 0, 1, 0deg); transform: rotate3d(0, 0, 1, 0deg); }
}

@-webkit-keyframes anim-close {
  0% { opacity: 1; }
  100% { opacity: 0; -webkit-transform: rotate3d(0, 0, 1, 45deg); }
}

@keyframes anim-close {
  0% { opacity: 1; }
  100% { opacity: 0; -webkit-transform: rotate3d(0, 0, 1, 45deg); transform: rotate3d(0, 0, 1, 45deg); }
}

/* Inner elements animations */

@-webkit-keyframes anim-elem {
  0% { opacity: 0; -webkit-transform: translate3d(0, -150px, 0) rotate3d(0, 0, 1, -20deg); }
  100% { opacity: 1; -webkit-transform: translate3d(0, 0, 0) rotate3d(0, 0, 1, 0deg); }
}

@keyframes anim-elem {
  0% { opacity: 0; -webkit-transform: translate3d(0, -150px, 0) rotate3d(0, 0, 1, -20deg); transform: translate3d(0, -150px, 0) rotate3d(0, 0, 1, -20deg); }
  100% { opacity: 1; -webkit-transform: translate3d(0, 0, 0) rotate3d(0, 0, 1, 0deg); transform: translate3d(0, 0, 0) rotate3d(0, 0, 1, 0deg); }
}

.pop-btn{width:65px; height:65px; background:#ddab30; border-radius:100%; text-align:center; line-height:65px; border:none; top: -64px; position: relative; transition:all 0.5s ease}
.pop-btn:hover{background:#523c3c}
.pop-input{background:#ebebeb !important; display: block; width: 100%; height: 58px; padding: 6px 30px; font-size: 14px; line-height: 1.42857143; border-radius:45px; border:5px solid ; color:#595151 }
.pop-text{background:#ebebeb !important; display: block; width: 100%; height: 100px; padding: 15px 30px; font-size: 14px; line-height: 1.42857143; border-radius:45px; border:5px solid; color:#595151; resize:none}
.pop-input::-moz-placeholder {
color:#595151;
opacity:1
}
.pop-input:-ms-input-placeholder {
color:#595151
}
.pop-input::-webkit-input-placeholder {
color:#595151
}
.pop-sub{text-transform:uppercase; font-size:24px; color:#f2ede7; padding:10px 40px; background:#ddab30; position: absolute; bottom: -50px; border: none; border-radius: 45px; left: 50%;   margin-left: -80px; transition:all 0.5s ease}
.pop-sub:hover{background:#523c3c}


/*POPUP*/

</style>
@include('layouts.partials.header')

<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="abt-hd">
      <h2>My Cart</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>my Cart</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>







<div class="cart-sec">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="cart-main clearfix">
     <div class="table-responsive">
       <table class="table table-bordered table-striped">
         <thead>
           <tr>
             <th>ITEMS IN YOUR CART</th>
             <th>PRICE</th>
             <th>AVALABILITY</th>
             <th>QUANTITY</th>
             <th>TOTAL PRICE</th>
             <th>&nbsp;</th>
           </tr>
         </thead>

         @if(! $carts->isEmpty())
         @foreach($carts as $cart)

         <tbody>
          <tr id="cart-{{$cart->id}}">
           <td width="30%">

            @if($cart->attributes->table == "shops") 
            <div class="item-lft"><img src="{{url('uploads/shops/'.$cart->attributes->get('image'))}}" class="img-responsive"></div>
            @elseif($cart->attributes->table == "apparels")
            <div class="item-lft"><img src="{{url('uploads/apparels/'.$cart->attributes->get('image'))}}" class="img-responsive"></div>
            @elseif($cart->attributes->table == "consoles")
            <div class="item-lft"><img src="{{url('uploads/console/'.$cart->attributes->get('image'))}}" class="img-responsive"></div>
            @endif

            <div class="item-txt"><h4>{{$cart->name}}</h4></div>
          </td>
          <td width="15%">{{$cart->price}}</td>
          <td width="15%">ONLY {{$cart->attributes->stock}} LEFT IN STOCK</td>
          <td width="20%">
           <div class="input-group quantity">
            <span class="input-group-btn">

              <button type="button" class="btn btn-minus btn-number" data-type="minus" data-field="quant-{{$cart->id}}">
                <span class="fa fa-minus"></span>
              </button>

            </span>


            <input type="text" id="quantity-{{$cart->id}}" name="quant-{{$cart->id}}" class="input-number number" value="{{$cart->quantity}}" min="1" max="{{$cart->attributes->stock}}" data-id="{{$cart->id}}" data-price="{{$cart->price}}">

            <span class="input-group-btn">
              <button type="button" class="btn btn-plus btn-number" data-type="plus" data-field="quant-{{$cart->id}}">
                <span class="fa fa-plus"></span>
              </button>
            </span>

          </div>
        </td>
        <td width="13%"><h4 class="ylw-color btn-number">QAR <label id="total-{{$cart->id}}">{{$cart->quantity * $cart->price}}</label></h4></td>
        <td width="7%">
          <a href="#" onclick="cart.removeFromCart('{{$cart->id}}')"><img src="{{url('assets/cheekycamel/images/cls.png')}}" width="30"></a>
        </td>
      </tr>
    </tbody>
    @endforeach
    @else

    {{-- user not logged in && cart is empty case here writing --}}
    <tbody>
      <tr>
        <td  colspan="6"  ><h4>Your Cart Is Empty !!</h4></td>
      </tr>
    </tbody>
    @endif 


  </table>
</div>

<div class="col-md-12 no-padding">

  <form method="" action="{{url('/')}}">
   <div class="pull-left"><button class="con-btn" type="submit" name="submit" value="continue">Continue Shopping</button></div>
   
 </form>

 <div class="pull-right"><a href="javascript:void(0)" class="check-cart trigger con-btn"  data-dialog="somedialog">Check Out</a></div>
 {{-- <form action="{{url('/users/login')}}" method="get"> --}}
  {{--  <div class="pull-right"><button class="con-btn" type="button" name="submit" value="checkout">Proceed to Checkout</button></div> --}}

  

{{--  </form> --}}

</div>

</div>
</div>

</div>

</div>


{{-- form fills blanks  --}}


 <div id="somedialog" class="dialog">
    <div class="dialog__overlay"></div>
    <div class="dialog__content">
        <button class="action pop-btn" data-dialog-close><img src="http://whytecreations.in/web/ccl/public/ccl/images/icons/pop-close.png"></button>
        <h2>Place Your Order</h2>
        <p>Fill below form and place your order</p>
        <form id="CheckoutForm" class="margin-top-40">
            <div class="form-group">
                <div class="col-md-12 margin-bottom-20"><input type="text" name="name" class="pop-input" placeholder="Name" required></div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 margin-bottom-20"><input type="email" id="emails" name="email" class="pop-input" placeholder="Email" ></div>
            </div>
            <div class="form-group">
                <div class="col-md-12 margin-bottom-20"><input type="number" name="phone" class="pop-input" placeholder="Phone" ></div>
            </div>
            <div class="form-group">
                <div class="col-md-12 margin-bottom-40"><textarea name="address" class="pop-text" placeholder="Address" required></textarea></div>
            </div>
            <div class="form-group">
                <p id="MailStatus" style="padding: 1em;"></p>
                <div class="col-md-12"><button id="checkoutSubmitBtn" type="submit" class="pop-sub">Send</button></div>
            </div>
        </form>
    </div>
</div>  



{{-- ######################### --}}




@include('layouts.partials.footer')

@endsection

@section('scripts')
@parent
<script src="{{url('assets/cheekycamel/js/modernizr.js')}}"></script>
<script src="{{url('assets/cheekycamel/js/classie.js')}}"></script>
<script src="{{url('assets/cheekycamel/js/dialogFx.js')}}"></script>
<script>
    (function() {
        var dlgtrigger = document.querySelector( '[data-dialog]' ),
            somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
            dlg = new DialogFx( somedialog );
        dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

    })();
</script>



{{-- <script src="http://whytecreations.in/web/ccl/public/ccl/js/main.js"></script> --}}
<script src="{{url('assets/cheekycamel/js/parallax.js')}}"></script>

<script>
  jQuery(document).ready(function () {
    $(window).scroll(function (e) {
      parallaxScroll();
    });
    function parallaxScroll() {
      var scrolled = $(window).scrollTop();
      $('#parallax-bg-3').css('top', 0 + scrolled * 0.10 + 'px');
    }
  });
  
  // $(document).ready(function() {
  //   $("#owl-demo").owlCarousel({
  //     autoPlay: 5000,
  //     items : 2,
  //     itemsDesktop : [1199,2],
  //     itemsDesktopSmall : [979,1]
  //   });

  // });

</script>




<script>

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

      //Change Total value
      id = $(this).attr('data-id');

      unitPrice = parseInt($(this).attr('data-price')); 
      
      totalPrice = valueCurrent * unitPrice;

      $("#total-"+id).html(totalPrice);


      cart.updateCart(id);


    });


  </script>

  <script type="text/javascript">
    var cart = {};
    cart.updateCart = function (id){

      quantity= $("#quantity-"+id).val();
      $.ajax({
        url: "{{ url('shop/updatecart')}}",
        type: 'POST',
        data:{id:id,quantity:quantity},
        success: function(data){
          $('#cartCount').html(data.cartCount);
          $('#cartTotalPrice').html(data.cartTotalPrice);
        },
        error: function(){
          console.log('Adding to cart failed');
        }
      });
    }


      // remove from cart
      cart.removeFromCart = function(id){
        $.ajax({
          url: "{{ url('tabletop/removefromcart')}}",
          type: 'DELETE',
          data:{id:id},
          success: function(data){
            $('#cart-'+id).remove();
            $('#cartCount').html(data.cartCount);
            $('#cartTotalPrice').html(data.cartTotalPrice);
          },
          error: function(){
            alert('Failed to remove from cart');
          }
        });
      }
    </script>

    <script type="text/javascript">
      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#CheckoutForm').submit(function(event) {
            event.preventDefault();
            $('#checkoutSubmitBtn').text('Sending...');
            $('#checkoutSubmitBtn').prop('disabled', true);
           
            var formData = {
                'name'       : $('input[name=name]').val(),
                 'email'      : $('input[type=email][name=email]').val(),
                //'email' : $('#emails').val(),
                'phone'      : $('input[name=phone]').val(),
                'address'    : $('textarea[name=address]').val()
            };

            $.ajax({
                type        : 'POST', 
                url         : '{{url('cart/checkout')}}', 
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true,
                success: function(data){
                  $("#MailStatus").html("<strong>Thank you!</strong> We will contact you soon.");
                },
                error: function(e){
                  console.log(e);
                  $("#MailStatus").html("<strong>Sorry! </strong> Couldnot send mail.");
                },
                complete: function(){
                     $('#checkoutSubmitBtn').prop('disabled', false);
                     $('#checkoutSubmitBtn').text('SEND');
                }
            })
        });
    });

</script>

@endsection