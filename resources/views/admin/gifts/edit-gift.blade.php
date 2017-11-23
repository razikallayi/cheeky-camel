@extends('admin.layout.app')

@section('title','Gift | Edit')

@section('active_menu','mnu-topss')
@section('active_submenu','add')

@section('styles')
@parent
<link href="{{url('assets/admin/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
<link href="{{url('assets/admin/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection



@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="card">
		<div class="body">

			<form id="form_validation" method="POST" action="{{url('admin/gift/edit/'.$gift->id)}}" enctype="multipart/form-data">
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

				<input type="hidden" name="id" value="{{$gift->id}}">
				<h2 class="card-inside-title">Category</h2>
				<div class="row clearfix">
					<div class="form-group col-sm-12">
						<select required class="form-control show-tick" name="category">
							<option value="">-- Select Category --</option>
							@foreach($category as $category)
							@if($category->id== old('category'))
							<option value="{{$category->id}}" selected>{{$category->category}}</option>
							@else
							<option value="{{$category->id}}">{{$category->category}}</option>
							@endif
							@endforeach
						</select>
					</div>
				</div>



				<h2 class="card-inside-title"> Title</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text" maxlength="60" value="{{$gift->title}}" name="title" class="form-control" required>
							</div>
						</div>
					</div>
				</div>


				<div class="col-sm-12 toggle-image">
					<div class="form-group">
					<label>Choose Image : <span>[Note: Use Images With Transparent Background] </span></label>
						{{-- <p class="help-block">Use images of width:1920px and height:570px for best quality</p> --}}
						<input id="ImageInput" type="file" style="max-width:75px; max-height:70px; overflow:hidden;cursor:pointer;font-size: 5em;" accept="image/*" name="image" class="col-indigo glyphicon glyphicon-picture fa-5x ">
						<div id="result" class="row">
							@if(null != $gift->image)
							<input type="hidden" name="image" value="{{$gift->image}}">
							<div id="image-preview-{{substr($gift->image,0,-4)}}" class="col-md-6 m-t-20" style="min-height:130px"><span><img class="img-responsive" src="{{url(App\Models\Gift::IMAGE_LOCATION)."/".$gift->image}}"></span></div>
							@endif
						</div>
					</div>
				</div>


				

				
				{{--<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Add Image :</label>
							<input id="ImageInput" type="file" style="max-width:75px; max-height:70px; overflow:hidden;cursor:pointer;font-size: 5em;" accept="image/*" name="image" class="col-indigo glyphicon glyphicon-picture fa-5x">
							
							<div id="result" class="img-preview preview-lg row">
								@if(null != old('image'))
								@foreach(old('image') as $imageName)
								<input type="hidden" id="image-input-{{substr($imageName,0,-4)}}" name = "image[]" value="{{$imageName}}">
								<div id="image-preview-{{substr($imageName,0,-4)}}" class="col-md-3" style="min-height:240px"><span><button type="button" onclick="deleteImage('{{$imageName}}')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button><img class="img-responsive" src="{{url(App\Models\Gift::IMAGE_LOCATION)."/".$imageName}}"></span></div>
								@endforeach
								@endif
							</div> 
						</div>
					</div>
				</div>--}}

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="">
								<input id="saveButton" type="submit" name="save" value="Save Data" class="btn btn-success waves-effect" >
							</div>
						</div>
					</div>
				</div>

			</form>			
		</div>
	</div>

</div>



<!-- Modal -->

<div id="CropperModal" class="modal fade" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg" role="document">
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
			{{-- <div class="modal-footer">
				<button type="button" class="btn btn-lg btn-success" data-dismiss="modal">Close</button>
				
			</div> --}}
		</div>
	</div>
</div>

@endsection


@section('scripts')
@parent


{{-- cropper --}}
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
    			aspectRatio: 445/643,
    			autoCrop: true,
    			autoCropArea: 1.0,
    			background: false,
    			checkImageOrigin: true,
    			dragCrop: false,
    			guides: false,
    			highlight: false,
    			modal: true,
    			movable: false,
    			mouseWheelZoom: true,
    			resizable: false,
    			responsive: false,
    			strict: true,
    			touchDragZoom: true,
    			zoomable: true
    		});
    	}).on('hidden.bs.modal', function() {
    		result.html('<div id="ImageLoading" class="col-sm-3 text-center"><h3>loading...</h3></div>');
    		$("#saveButton").attr('disabled',true);

    		var location= "{{App\Models\Gift::IMAGE_LOCATION}}";

    		$.ajax({
    			url : "{{url('admin/gift/upload-image')}}",
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

<script type="text/javascript">
//Used for all Ajax posts
// CSRF protection
$.ajaxSetup({
	headers: {
		'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
	}
});
</script>


@endsection