@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">


		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-orange">
					<h2>Brands</h2>
				</div>
				<div class="body">
					<div class="list-group">
						<a href="{{url('admin/brands')}}" class="list-group-item">Add</a>
						<a href="{{url('admin/manage/brands')}}" class="list-group-item">Manage</a>
					</div>
				</div>
			</div>
		</div>  


		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-orange">
					<h2>Table Top</h2>
				</div>
				<div class="body">
					<div class="list-group">
						<a href="{{url('admin/shop')}}" class="list-group-item">Add</a>
						<a href="{{url('admin/manage/tabletop')}}" class="list-group-item">Manage</a>
					</div>
				</div>
			</div>
		</div>  


		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-orange">
					<h2>Apparels</h2>
				</div>
				<div class="body">
					<div class="list-group">
						<a href="{{url('admin/apparels')}}" class="list-group-item">Add</a>
						<a href="{{url('admin/apparels/manage')}}" class="list-group-item">Manage</a>
					</div>
				</div>
			</div>
		</div>  

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-orange">
					<h2>Console</h2>
				</div>
				<div class="body">
					<div class="list-group">
						<a href="{{url('admin/console')}}" class="list-group-item">Add</a>
						<a href="{{url('admin/console/manage')}}" class="list-group-item">Manage</a>
					</div>
				</div>
			</div>
		</div>  



		



</div>
@endsection

@section('scripts')
@parent

<script type="text/javascript">
//Activate current item in left side menu
$(document).ready(function() {
   $(".menu .list li").removeClass('active');
   $("#mnu-dashboard").addClass('active').find('a').click();
});
</script>

@endsection