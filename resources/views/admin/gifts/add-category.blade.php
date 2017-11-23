@extends('admin.layout.app')

@section('title','Gift | Category')

@section('active_menu','mnu-tossp')
@section('active_submenu','add')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="card">
		<div class="body">

			<form id="form_validation" method="POST" action="{{url('admin/gift/add-category')}}" enctype="multipart/form-data">
				{{csrf_field()}}

				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				<h2 class="card-inside-title"> Category</h2>

				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text" name="category" maxlength="80" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				

				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="">
								<input type="submit" id="saveButton" name="save" value="Save Data" class="btn btn-success waves-effect" >
							</div>
						</div>
					</div>
				</div>

			</form>			
		</div>
	</div>

</div>

@endsection

@section('scripts')
@parent

<script type="text/javascript">
//Activate current item in left side menu
// $(document).ready(function() {
// 	$(".menu .list li").removeClass('active');
// 	$("#mnu-product").addClass('active').find('a').click();
// });
</script>

@endsection