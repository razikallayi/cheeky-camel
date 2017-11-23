@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')

@section('content')

@include('layouts.partials.header')


<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">

    <div class="abt-hd">
      <h2>Contact Us</h2>

      @if(Session::has('mail_success'))

      <h4 style="text-align: center;color: yellow;">{{Session::get('mail_success')}}</h4>
      @endif

      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>Contact Us</li>
        </ul>
      </div>
    </div>
  </div>

</div>
</div>



<div class="con">
 <div class="container">
   <div class="col-md-12 no-padding">
    <div class="gmap">
     <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14431.491717215808!2d51.55181325!3d25.2748597!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sqa!4v1481615124630" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
   </div>

   <div class="con-sec clearfix">
    <div class="col-md-6">
    <form action="{{url('/contact-us')}}" method="post" id="contact-us-label-form">
    {{csrf_field()}}
      <div class="field">
        <input type="text" id="cname" name="name" required />
        <label for="cname">Name</label>
      </div>
      <div class="field">
        <input type="text" id="cemail" name="email" required />
        <label for="cemail">Email</label>
      </div>
      <div class="field">
        <input type="text" id="Phone" name="phone" required/>
        <label for="Phone">Phone</label>
      </div>
      <div class="field">
        <textarea id="message" name="message" required></textarea>
        <label for="message">Message</label>
      </div>
      <button class="con-btn" type="submit">SEND</button>
    </form>

    

  </div>
  <div class="col-md-6">
   <div class="con-det">
    <ul>
      <li class="ad"><h4>Office Address</h4> <p> Bin Mahmoud St, All Shopping Complex Doha, Qatar </p></li>
      <li class="phn"><h4>Phone</h4> <p> 3352 7375 </p></li>
      <li class="em"><h4>Email</h4><p><a href="#">info@cheekycamel.com</a></p></li>
      <li class="sr"><h4>Social</h4> <a href="#"><i class="fa fa-youtube-play"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a></li>
    </ul>
  </div>
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
  $(function() {
    var pgurl = window.location.href.substr(window.location.href
      .lastIndexOf("/")+1);
    $("#navbar-menu ul li").each(function(){
      if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
        $('a').removeClass('active');
      $("#contact").addClass("active");
    })
  });
</script>

@endsection