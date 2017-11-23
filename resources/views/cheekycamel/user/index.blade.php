@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')

@section('content')

@include('layouts.partials.header')

<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
     @if(Session::has('success_login'))
     <h4 style="text-align: center;color: green;">{{Session::get('success_login')}}</h4>
     @endif
     
     <div class="abt-hd">
      <h2>My Account</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>My Account</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>



<div class="login-sec">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="login-main clearfix">
     <div class="tabs">
      <div class="tab">
        <div class="tab-toggle"><h2>Personal Info</h2></div>
      </div>
      <div class="content">
        <h3>Personal Info</h3>
        <div class="row">

          <form method="post" id="account" action="{{url('/user/account')}}" id="form_validation">



            {{csrf_field()}}
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{$registration->name == null ?"":$registration->name}}" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="{{$registration->email}}" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{$registration->phone == null ?"":$registration->phone}}" class="form-control" required>
              </div>
              @if($registration->gender != null)

              <div class="form-group clearfix">
                <div class="switch-field">
                  <div class="switch-title">Gender</div>
                  <input type="radio" id="switch_left" {{$registration->gender == "male"?"checked" : ""}} name="gender" value="male" />
                  <label for="switch_left">Male</label>
                  <input type="radio" id="switch_right" {{$registration->gender == "female"?"checked" : ""}} name="gender" value="female" />
                  <label for="switch_right">Female</label>
                </div>
              </div>
              @else
               <div class="form-group clearfix">
                <div class="switch-field">
                  <div class="switch-title">Gender</div>
                  <input type="radio" id="switch_left"  name="gender" value="male" />
                  <label for="switch_left">Male</label>
                  <input type="radio" id="switch_right"  name="gender" value="female" />
                  <label for="switch_right">Female</label>
                </div>
              </div>
              @endif
              <div class="form-group">
                <button class="con-btn" type="submit" id="submit" name="save">Save Changes</button>
              </div>
            </div>
          </form>

          <form method="post" action="{{url('/save/password')}}">
           {{csrf_field()}}
           <div class="col-md-6 cp">
            <h3>Change Password</h3>

            <div class="form-group">
              <label>Current Password</label>
              <input type="text" name="current_password" class="form-control" required>
            </div>

            <div class="form-group">
              <label>New Password</label>
              <input type="text" name="new_password" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Confirm Password</label>
              <input type="text" name="password" class="form-control" required>
            </div>

            <div class="form-group">
              <button class="con-btn" name="save" type="submit">Save Changes</button>
            </div>
          </div>
        </form>

      </div>
    </div>

{{--  ##################### My orders

    <div class="tab">
      <div class="tab-toggle"><h2>My Orders</h2></div>
    </div>

    <div class="content">
      <h3>My Orders</h3>
      <div class="col-md-8 no-padding margin-top-20">
        <div class="form-group">
         <label>Order No</label>
         <div class="input-group add-on">
          <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 no-padding">

      <div class="table-responsive">
       <table class="table table-bordered table-striped">
        <thead>
         <tr>
           <th>Order No</th>
           <th>Order Status</th>
           <th>Payment Status</th>
           <th>Payment Method</th>
           <th>Order Date</th>
         </tr>
       </thead>

       <tbody>
         <tr>
           <td>Order No</td>
           <td>Order Status</td>
           <td>Payment Status</td>
           <td>Payment Method</td>
           <td>Order Date</td>
         </tr>

         <tr>
           <td>Order No</td>
           <td>Order Status</td>
           <td>Payment Status</td>
           <td>Payment Method</td>
           <td>Order Date</td>
         </tr>

         <tr>
           <td>Order No</td>
           <td>Order Status</td>
           <td>Payment Status</td>
           <td>Payment Method</td>
           <td>Order Date</td>
         </tr>

       </tbody>

     </table>
   </div>

 </div>
</div>
--}}

{{-- ############## track my orders 

<div class="tab">
  <div class="tab-toggle"><h2>Track My Orders</h2></div>
</div>
<div class="content">
  <h3>Track My Orders</h3>
  <p>
    Track the progress of your Order.</p>
    <p>
      Enter your Order No below and click "Track Order" to view status of your order.</p>

      <div class="col-md-8 no-padding">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Order / Tracking No.">
        </div>

        <div class="form-group">
          <button class="con-btn">Track my Order</button>
        </div>

      </div>

    </div>
--}}

  </div>
</div>
</div>
</div>

</div>

@include('layouts.partials.footer')
@endsection

@section('scripts')
@parent
<script src="{{url('assets/admin/js/admin.js')}}"></script>
{{-- <script src="{{url('assets/admin/plugins/jquery-validation/jquery.validate.js')}}"></script>
--}}
<script src="{{url('assets/admin/js/pages/forms/form-validation.js')}}"></script>



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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



<script type="text/javascript">
  $(function() {
    $("#submit").click(function() {
      var name = $("#name").val();
      var email = 'email='+ email;
      if(email=='')
      {
        alert("Enter some text..");
        $("#content").focus();
      }
      else
      {
        $("#flash").show();
        $("#flash").fadeIn(400).html('<span class="load">Loading..</span>');
        $.ajax({
          type: "POST",
          url: {{url('/')}},
          data: dataString,
          cache: true,
          success: function(html){
            $("#show").after(html);
            document.getElementById('content').value='';
            $("#flash").hide();
            $("#content").focus();
          }  
        });
      }
      return false;
    });
  });
</script>
@endsection