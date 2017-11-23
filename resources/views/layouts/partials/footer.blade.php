<footer>

  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="ftr clearfix">
     <div class="col-md-8 no-padding">
       <div class="ftr-link">
        <div class="row">
         <div class="col-md-4">
          <h4> <span> YOUR </span> ACCOUNT</h4>
          <ul>
           <li><a href=".register" data-toggle="modal">Sign in or Register</a></li>
           <li><a href="#">Newsletter</a></li>
         </ul>
         <h4> <span> CUSTOMER  </span> SUPPORT</h4>
         <ul> 
           <li><a href="#">Help Center</a></li> {{-- help-center.php --}}
           <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
         </ul>
       </div>
       
       <div class="col-md-4">
        <h4> <span> SHOP </span>  WITH US</h4>
        <ul>
         <li><a href="#">Why Cheeky camel</a></li> {{-- why-cheeky.php --}}
         <li><a href="{{url('/our-brands')}}">Our Brands</a></li>
         <li><a >Browse Characters</a></li>
         <li><a >Products by Type</a></li>
         <li><a >Products by Price</a></li>
         <li><a href="{{url('/gift')}}">Gift boxes</a></li> {{-- gift.php--}}
       </ul>
     </div>
     
     <div class="col-md-4">
      <h4> <span> ABOUT </span>  Cheeky Camel</h4>
      <ul>
       <li><a href="{{url('about-us')}}">About Us</a></li>
       <li><a href="#">Studio Tour</a></li>
       <li><a href="#">Wholesale Program</a></li>
       <li><a href="#">Careers</a></li>
     </ul>
   </div>
   
 </div>
</div>
</div>

<div class="col-md-4 no-padding">
  <div class="sub">
    <h2>Subscribe</h2>
    <h4>newsletter</h4>
    <form method="post" action="{{url('/newsletter/subscribe')}}">
    {{csrf_field()}}
    <div class="col-md-12 no-padding">
      <div class="left-inner-addon ">
        <i class="fa fa-envelope"></i>
        <input type="text" class="news-le" name="email" placeholder="Enter Your Email" />
      </div>
      <button class="sub-btn" style="font-size: 19px;" type="submit">subscribe</button>
    </div>
    </form>
    <p>Lorem Ipsum is simply dummy <br> text of the printing</p>
  </div>
</div>

</div>
</div>
<div class="ftr-btm">
  <div class="ftr-lft"><p>© 2016 CHEECKY CAMEL All Right Reserved. </p></div>
  <div class="ftr-rgt"><p>Powered by <a href="http://www.whytecreations.com/" target="_blank" rel="dofollow"> <img src="{{url('assets/cheekycamel/images/whyte.png')}}"> WHYTE COMPANY </a></p></div>
</div>
</div>

</footer>