@extends('admin.layout.app')

@section('title','Apparels | Add')

@section('active_menu','mnu-apps')
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

			<form id="form_validation" method="POST" action="{{url('admin/apparels')}}" enctype="multipart/form-data">
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



				<h2 class="card-inside-title">Item Name</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text" maxlength="60" value="{{old('itemname')}}" name="itemname" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Description</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<textarea id="" name="description"  maxlength="50000" class="form-control" required>{{old('description')}}</textarea>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Quantity [In stock]</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="number" min="0" max="100000"  value="{{old('quantity')}}" name="quantity" class="form-control" required>
							</div>
						</div>
					</div>
				</div>



				<h2 class="card-inside-title">Price</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="number" min="1" max="100000"  value="{{old('price')}}" name="price" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				
				<h2 class="card-inside-title">Discount [in percentage]<span><small>[Optional]</small></span></h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="number" value="0" min="0" max="100" value="{{old('discount')}}" name="discount" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Theme</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text" value="{{old('theme')}}" name="theme" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Mechanic</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text" value="{{old('mechanic')}}" name="mechanic" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Minimum Age</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="number"  min="0" max="100" value="{{old('minage')}}" name="minage" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Minimum Players</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="number"  min="0" max="100" value="{{old('players')}}" name="players" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Playing Time [In Hours]</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text"  min="0" max="100" value="{{old('time')}}" name="time" class="form-control" required>
							</div>
						</div>
					</div>
				</div>

				<h2 class="card-inside-title">Publisher </h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group ">
							<div class="form-line">
								<input type="text" value="{{old('publisher')}}" name="publisher" class="form-control" required>
							</div>
						</div>
					</div>
				</div>


				<div class="demo-checkbox">
				<input type="hidden" name="newitem" id="md_checkbox_30"  class="filled-in chk-col-pink" value="{{old('newitem')}}"  />
					{{-- <label for="md_checkbox_30">Published In Latest Products</label> --}}
				</div>


				
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label>Add Image :</label>
							<input id="ImageInput" type="file" style="max-width:75px; max-height:70px; overflow:hidden;cursor:pointer;font-size: 5em;" accept="image/*" name="image" class="col-indigo glyphicon glyphicon-picture fa-5x">
							<div id="result" class="img-preview preview-lg row">
								@if(null != old('image'))
								@foreach(old('image') as $imageName)
								<input type="hidden" id="image-input-{{substr($imageName,0,-4)}}" name = "image[]" value="{{$imageName}}">
								<div id="image-preview-{{substr($imageName,0,-4)}}" class="col-md-3" style="min-height:240px"><span><button type="button" onclick="deleteImage('{{$imageName}}')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button><img class="img-responsive" src="{{url(App\Models\Apparel_image::IMAGE_LOCATION)."/".$imageName}}"></span></div>
								@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>

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


{{-- cropper --}}
<script src="{{url('assets/admin/plugins/cropper/cropper.min.js')}}"></script>
<script>
	$(function() {
		result = $('#result');
		image = $(".featured_image > img");

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

    	$('#CropperModal').on('shown.bs.modal', function() {
    		image.cropper({
    			aspectRatio: 270/350,
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
    		result.append('<div id="ImageLoading" class="col-sm-3 text-center"><h3>loading...</h3></div>');
    		$("#saveButton").attr('disabled',true);

    		var location= "{{App\Models\Apparel_image::IMAGE_LOCATION}}";
    		$.ajax({
    			url : "{{url('admin/apparels/upload-image')}}", 
    			type: "POST",
    			data:  {
    				image: image.cropper("getCroppedCanvas").toDataURL(),
    				location:location,
    			},
    			success:function(data) {
    				console.log(data);
    				if(data=="" || data == undefined) {return};
    				if(data.filename==undefined) {return;}
    				$('#ImageInput').val("");

				// Show
				result.append('<div id="image-preview-'+data.filename.slice(0,-4)+'" class="col-md-3" style="min-height:240px"><span><button type="button" onclick="deleteImage(\''+data.filename+'\')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button><img class="img-responsive" src="' + data.src + '"></span></div>');

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
    		image.cropper('destroy');
    	});
    });
	var deleteImage = function(filename){
		$.ajax({
			url: "{{ url('admin/apparel/delete')}}",
			type: 'DELETE',
			data:{location:"{{App\Models\Apparel_image::IMAGE_LOCATION}}",
			filename:filename
		},
		success: function(){
			$('#image-input-'+filename.slice(0,-4)).remove();
			$('#image-preview-'+filename.slice(0,-4)).remove();
		},
		error: function(){
			alert('failed');
		}
	});
	}
</script>



<script type="text/javascript">
//Activate current item in left side menu
// $(document).ready(function() {
// 	$(".menu .list li").removeClass('active');
// 	$("#mnu-app").addClass('active').find('a').click();
// });
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