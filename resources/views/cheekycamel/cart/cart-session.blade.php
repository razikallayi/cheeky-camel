@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

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

         {{-- user not logged in && cart is not empty case here writing --}}
         @if(!Session::has('user_email'))
         @if(! $carts->isEmpty())

         @foreach($carts as $cart)

         <tbody>
          <tr>
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
           <td width="15%">ONLY {{$cart->quantity}} LEFT IN STOCK</td>
           <td width="20%">
             <div class="input-group quantity">
              <span class="input-group-btn">

                <button type="button" class="btn btn-minus btn-number" data-type="minus" data-field="quant-{{$cart->id}}">
                  <span class="fa fa-minus"></span>
                </button>

              </span>


              <input type="text" id="quantity-{{$cart->id}}" name="quant-{{$cart->id}}" class="input-number number" value="{{$cart->quantity}}" min="1" max="{{$cart->quantity}}" data-id="{{$cart->id}}" data-price="{{$cart->price}}">

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

      @else
      @if(! $carts->isEmpty())
      @foreach($carts as $cart)


      {{-- user logged in && cart is not empty writing here  --}}

      {{-- <thead>
       <tr>
         <th>ITEMS IN YOUR CART</th>
         <th>PRICE</th>
         <th>AVALABILITY</th>
         <th>QUANTITY</th>
         <th>TOTAL PRICE</th>
         <th>&nbsp;</th>
       </tr>
     </thead> --}}

     <tbody>
      <tr>
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
       <td width="15%">ONLY {{$cart->quantity}} LEFT IN STOCK</td>
       <td width="20%">
         <div class="input-group quantity">
          <span class="input-group-btn">

            <button type="button" class="btn btn-minus btn-number" data-type="minus" data-field="quant-{{$cart->id}}">
              <span class="fa fa-minus"></span>
            </button>

          </span>


          <input type="text" id="quantity-{{$cart->id}}" name="quant-{{$cart->id}}" class="input-number number" value="1" min="1" max="30" data-id="{{$cart->id}}" data-price="{{$cart->price}}">

          <span class="input-group-btn">
            <button type="button" class="btn btn-plus btn-number" data-type="plus" data-field="quant-{{$cart->id}}">
              <span class="fa fa-plus"></span>
            </button>
          </span>

        </div>
      </td>
      <td width="13%"><h4 class="ylw-color btn-number">QAR <label id="total-{{$cart->id}}">{{$cart->quantity * $cart->price}}</label></h4></td>
      <td width="7%">
        <a href="#" onclick="cart.removeFromCart({{$cart->id}})"><img src="{{url('assets/cheekycamel/images/cls.png')}}" width="30"></a>
      </td>
    </tr>
  </tbody>

  @endforeach
  @else

  {{-- user logged in && cart is empty writing here  --}}
  
  <tbody>
    <tr>
      <td colspan="6"><h4>Your Cart Is Empty !!</h4></td>
    </tr>
  </tbody>

  @endif
  @endif 


</table>
</div>

<div class="col-md-12 no-padding">

  <form method="" action="{{url('/')}}">
   <div class="pull-left"><button class="con-btn" type="submit" name="submit" value="continue">Continue Shopping</button></div>
 </form>

 <form action="{{url('/users/login')}}" method="get">
   <div class="pull-right"><button class="con-btn" type="submit" name="submit" value="checkout">Proceed to Checkout</button></div>
 </form>

</div>

</div>
</div>

</div>

</div>







@include('layouts.partials.footer')

@endsection

@section('scripts')
@parent

<script>

  $('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    console.log(input);
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

@endsection