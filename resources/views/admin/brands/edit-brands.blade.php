@extends('admin.layout.app')

@section('title','Brand | Edit')

@section('active_menu','mnu-catss')
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


				<form id="form_validation" method="POST" action="{{url('admin/brands/'.$brands->id)}}" enctype="multipart/form-data">
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

					<input type="hidden" name="id" value="{{$brands->id}}">

					<div class="row clearfix">
						<div class="col-sm-6">
							<label>Title</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" value="{{$brands->title}}" name="title" maxlength="6000" class="form-control" required="">
								</div>
							</div>
						</div>

					</div>

					<div class="row clearfix">
						<div class="col-sm-6">
							<label>Description</label>
							<div class="form-group">
								<div class="form-line">
									<textarea name="description"  required class="form-control htmlEditor">{{$brands->description}}</textarea>
								</div>
							</div>
						</div>

					</div>



					<div class="col-sm-12 toggle-image">
						<div class="form-group">
							<label class="">Image :</label>
							{{-- <p class="help-block">Use images of width:1920px and height:570px for best quality</p> --}}
							<input id="ImageInput" type="file" style="max-width:75px; max-height:70px; overflow:hidden;cursor:pointer;font-size: 5em;" accept="image/*" name="image" class="col-indigo glyphicon glyphicon-picture fa-5x ">
							<div id="result" class="row">
								@if(null != $brands->logo)
								
								<input type="hidden" name="image" value="{{$brands->logo}}">
								<div id="image-preview-{{substr($brands->logo,0,-4)}}" class="col-md-6 m-t-20" style="min-height:130px"><span><img class="img-responsive" src="{{url(App\Models\Brand::IMAGE_LOCATION)."/".$brands->logo}}"></span></div>
								@endif
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



<!-- Modal -->

<div id="CropperModal" class="modal fade" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalLabel">Crop the image</h4>
			</div>
			<div class="modal-body">

				<div class="featured_image">
					<img id="CropperImage" alt="Crop Image" />
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-lg btn-success" data-dismiss="modal">Crop</button>
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
$(document).ready(function() {
	$(".menu .list li").removeClass('active');
	$("#mnu-brand").addClass('active').find('a').click();
});
</script>


<script src="{{url('assets/admin/plugins/cropper/cropper.min.js')}}"></script>
<script>
$(function() {
    	result = $('#result');
    	$("#ImageInput").change(function() {
    		if (this.files && this.files[0]) {
    			displayCropper(this);
    		}
    	});

    	function displayCropper(input) {
    		//Set src of Modal as input Image
    		var reader = new FileReader();
    		reader.onload = function(e) {
    			$('#CropperImage').attr("src", e.target.result);
    			$('#CropperModal').modal({
    				backdrop: 'static',
    				keyboard: false
    			});
    		}
    		if (input instanceof File) {
    			reader.readAsDataURL(input);
    		} else {
    			reader.readAsDataURL(input.files[0]);
    		}
    	}

	var $image = $(".featured_image > img");

	$('#CropperModal').on('shown.bs.modal', function() {
		$image.cropper({
			aspectRatio: 142/134,
			autoCrop: true,
			autoCropArea: 1.0,
			background: false,
			checkImageOrigin: true,
			dragCrop: false,
			guides: false,
			highlight: false,
			modal: true,
			movable: false,
			mouseWheelZoom: false,
			resizable: false,
			responsive: false,
			strict: true,
			touchDragZoom: false,
			zoomable: false
		});
	}).on('hidden.bs.modal', function() {
		result.html('<div id="ImageLoading" class="col-sm-3 text-center"><h3>loading...</h3></div>');
		$("#saveButton").attr('disabled',true);

		var location= "{{App\Models\Brand::IMAGE_LOCATION}}";

		$.ajax({
		    url : "{{url('admin/brand/upload-image')}}",
		    type: "POST",
		    data:  {
				image: $image.cropper("getCroppedCanvas").toDataURL(),
				location:location,
			},
			success:function(data) {
				$('#ImageInput').val("");

				// Show
				result.html('<div id="image-preview-'+data.filename.slice(0,-4)+'" class="col-md-3" style="min-height:100px"><span><img class="img-responsive" src="' + data.src + '"></span></div>');

				$('<input>').attr('type','hidden')
								.attr('id','image-input-'+data.filename.slice(0,-4))
								.attr('name','image[]')
								.attr('value',data.filename)
								.appendTo('#result');
				},
			error: function(){
	    			console.log('failed to upload image');
	    		},
			complete: function(){
					$("#saveButton").attr('disabled',false);
	    			$('#ImageLoading').remove();
	    		}
		    });
			$image.cropper('destroy');
		});
	});

	
</script>


@endsection

