@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

@include('layouts.partials.header')



<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="abt-hd">
      <h2>Gift Boxes</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>Gift</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>



<div class="gft">
  <div class="container">
   <div class="gft-sec clearfix">

     @foreach($giftboxes as $giftbox)
     
     <div class="col-md-3">
       <div class="gift-item">
        <div class="sp-thumbnail-img">
         <img src="{{url('uploads/gifts/'.$giftbox->image)}}" width="110" height="158">
       </div>
       <h2>{{$giftbox->title}}<br> <span>{{$giftbox->category()->first()->category}} </span> </h2> <a href="#">
       <img src="{{url('assets/cheekycamel/images/gift/more.png')}}"></a></div>
     </div>

     @endforeach

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
			$("#gift").addClass("active");
		})
	});
</script>

@endsection
