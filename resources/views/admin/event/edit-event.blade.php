@extends('admin.layout.app')

@section('title','Event | edit')

@section('active_menu','mnu-brands')
@section('active_submenu','add')

@section('styles')
@parent
<link href="{{url('assets/admin/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="body">

			<form id="form_validation" method="POST" action="{{url('admin/event/edit-event/'.$event->id)}}" enctype="multipart/form-data">
				{{csrf_field()}}
				{{method_field('PUT')}}
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<input type="hidden" name="id" value="{{$event->id}}">

				<div class="row clearfix">
					<div class="col-sm-12">
					<label>Title</label>
						<div class="form-group ">
							<div class="form-line">
								<input type="text" value="{{$event->event_title}}" name="title"  class="form-control" required="">
							</div>
						</div>
					</div>
					
				</div>

				<div class="row clearfix">
					<div class="col-sm-12">
						<label>Description</label>
						<div class="form-group">
							<div class="form-line">
								<textarea name="description"  required class="form-control htmlEditor">{{$event->event_description}}</textarea>
							</div>
						</div>
				  </div>
				</div>

				

				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="">
								<input type="submit" id="saveButton" name="save" value="Save Data" class="btn btn-lg btn-success waves-effect" >
							</div>
						</div>
					</div>
				</div>

			</form>			
		</div>
	</div>

</div>
</div>




@endsection




@section('scripts')
@parent



<script type="text/javascript">
//Used for all Ajax posts
// CSRF protection
	$.ajaxSetup({
	headers: {
		'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

<script type="text/javascript">
//Activate current item in left side menu
// $(document).ready(function() {
// 	$(".menu .list li").removeClass('active');
// 	$("#mnu-brand").addClass('active').find('a').click();
// });
</script>


@endsection

