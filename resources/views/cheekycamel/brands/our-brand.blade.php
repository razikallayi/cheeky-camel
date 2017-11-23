@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')
@section('content')

@include('layouts.partials.header')



<div class="abt-tp">
	<div class="container">
		<div class="col-md-12 no-padding">
			<div class="abt-hd">
				<h2>Our Brands</h2>
				<div class="breadcrumb">
					<ul>
						<li><a href="{{url('/')}}">Home</a></li>
						<li>Our Brands</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="brand">
	<div class="container">
		<div class="col-md-12 no-padding">
			<div class="brand-sec clearfix">

				@foreach($brands as $brand)
				<div class="col-md-3">
					<div class="box">
						<a href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
							<line class="top" x1="0" y1="0" x2="900" y2="0"/>
							<line class="left" x1="0" y1="134" x2="0" y2="-920"/>
							<line class="bottom" x1="235" y1="134" x2="-600" y2="134"/>
							<line class="right" x1="235" y1="0" x2="235" y2="1380"/>
						</svg>
						<img src="{{url('uploads/brands/'.$brand->logo)}}"></a>
					</div>
				</div>
				@endforeach


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
			$("#brand").addClass("active");
		})
	});
</script>
@endsection
