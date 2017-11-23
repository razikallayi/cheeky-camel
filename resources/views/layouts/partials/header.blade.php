<nav class="navbar bootsnav">
  <div class="container">  
    <div class="nav-tp clearfix">

      <div class="social">
       <ul>
       @if(Session::has('user_email'))
         <li><a href="{{url('/users/login')}}" title="My Account"><i class="fa fa-user-circle" aria-hidden="true" title="My Account" ></i></a></li>
       @endif
         <li><a href="#"> <i class="fa fa-youtube-play"></i> </a></li>
         <li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
         <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>

       </ul>
     </div>

     <div class="reg"><a href=".register" data-toggle="modal"> <img src="{{url('assets/cheekycamel/images/reg.png')}}"> Register </a></div>

     @if(Session::has('user_email') && Session::has('password'))
     <div class="login"><a href="{{url('/user/logout')}}"  data-toggle="modal"> <img src="{{url('assets/cheekycamel/images/login.png')}}"> Logout </a></div>
     @else
     <div class="login"><a href="#login" data-toggle="modal"> <img src="{{url('assets/cheekycamel/images/login.png')}}"> Login </a></div>
     @endif



   </div>
   <!-- Start Atribute Navigation -->
   <div class="attr-nav">
    <ul>
  
      <li class="cart"><a href="{{url('/cart')}}"><img src="{{url('assets/cheekycamel/images/cart.png')}}"><label id="cartCount">{{Cart::getContent()->count()>0?Cart::getContent()->count():""}}</label></a>
      </li>
    
    </ul>
  </div>        
  <!-- End Atribute Navigation -->


  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
      <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand" href="{{url('/')}}"><img src="{{url('assets/cheekycamel/images/logo.png')}}" class="logo" alt=""></a>
  </div>

  <div class="collapse navbar-collapse" id="navbar-menu">


    <ul class="nav navbar-nav navbar-right">
      <li id="home"><a href="{{url('/')}}">Home</a></li>                    
      <li id="about"><a href="{{url('/about-us')}}">ABOUT</a></li>
      <li id="collectibles"><a href="{{url('/tabletop')}}">Tabletop</a></li>
      <li id="apparels"><a href="{{url('/apparels')}}">APPARELS </a></li>
      <li id="console"><a href="{{url('/console')}}">Console </a></li>
      <li id="calender"><a href="{{url('/calendar')}}">Calendar </a></li>
      <li id="gift"><a href="{{url('/gift')}}">GIFT</a></li>
      <li id="contact"><a href="{{url('/contact-us')}}">CONTACT</a></li>
    </ul>


  </div>

</div>   
</nav>


<div id="login" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
       <form method="post" action="{{url('/login/home')}}">

          {{csrf_field()}}
         {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="field">
          <input type="text" id="name" />
          <label for="name">User Name</label>
        </div> --}}

        <div class="field">
          <input type="text" id="email" name="email" value="{{old('email')}}" required />
          <label for="email">Email</label>
        </div>

        <div class="field">
          <input type="password" id="Password" name="password"  required value="{{old('password')}}" />
          <label for="Password">Password</label>
        </div>

        <button class="btn-login" type="Submit">Submit</button>
        
      </form>
    </div>

  </div>
</div>
</div>

<div class="modal register fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Register</h4>
      </div>
      <div class="modal-body">
       <form  method="post" action="{{url('/register')}}">
        {{csrf_field()}}
        
        <div class="field">
          <input type="text" id="uname" name="username" value="{{old('username')}}"  required />
          <label for="uname">User Name</label>
        </div>


        <div class="field">
          <input type="text" id="emails" name="emails" value="{{old('emails')}}" required />
          <label for="emails">Email</label>
        </div>


        
        <div class="field">
          <input type="password" id="nPassword" name="password" value="{{old('password')}}" required />
          <label for="nPassword">Password</label>
        </div>
        

       {{--  <div class="field">
          <input type="password" id="nPassword" name="password" value="{{old('password')}}" required />
          <label for="nPassword">Password</label>
        </div> --}}
        
        <button class="btn-login" type="submit" name="submits">Submit</button>

      </form>
    </div>

  </div>
</div>
</div>