@extends('admin.layout.app')

@section('title','Brand | Add')

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

			<form id="form_validation" method="POST" action="{{url('admin/brands')}}" enctype="multipart/form-data">
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

				<div class="row clearfix">
					<div class="col-sm-6">
					<label>Title</label>
						<div class="form-group ">
							<div class="form-line">
								<input type="text" value="{{old('title')}}" name="title" maxlength="6000" class="form-control" required="">
							</div>
						</div>
					</div>
					
				</div>

				<div class="row clearfix">
					<div class="col-sm-6">
						<label>Description</label>
						<div class="form-group">
							<div class="form-line">
								<textarea name="description"  required class="form-control htmlEditor">{{old('description')}}</textarea>
							</div>
						</div>
					</div>
					
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
								<div id="image-preview-{{substr($imageName,0,-4)}}" class="col-md-3" style="min-height:240px"><span>
								
								{{-- <button type="button" onclick="deleteImage('{{$imageName}}')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button> --}}

								<img class="img-responsive" src="{{url(App\Models\Brand::IMAGE_LOCATION)."/".$imageName}}"></span></div>
								@endforeach
								@endif
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
//<button type="button" onclick="deleteImage(\''+data.filename+'\')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button>
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





<script>
	storageLocation= "{{App\Models\Brand::IMAGE_LOCATION}}";
	postUrl = "{{url('admin/brands/upload-image')}}";
	$result = $('#result');
	$saveButton = $("#saveButton");
	$imageInput =$("#ImageInput");
	$(function() {
		$imageInput.change(function() {
			if (this.files && this.files[0]) {
				$.each(this.files,function(index, el) {
					var reader = new FileReader();
					reader.onload = function(e) {
					$saveButton.attr('disabled',true);
					var loadingHtml = '<div id="ImageLoading" class="loader col-sm-3 m-t-60 text-center"><div class="md-preloader pl-size-md"><svg viewBox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" class="pl-blue" stroke-width="4"></circle></svg></div></div>';
					$result.append(loadingHtml);
					saveAndDisplay(e.target.result);
					}
					if (this instanceof File) {
						reader.readAsDataURL(this);
					} else {
						reader.readAsDataURL(this.files[0]);
					}
				});
			}
		});
	});


	function saveAndDisplay (file){
			var uploadedFile= file;
			//Ajax image save
			$.ajax({
				url: postUrl,
				type: "POST",
				data:{image: uploadedFile,
					location:storageLocation},
					success: function(data) {
						// Show
						$result.append('<div id="image-preview-'+data.filename.slice(0,-4)+'" class="col-md-3 m-t-30" style="min-height:100px"><button type="button" onclick="deleteImage(\''+data.filename+'\')" class="btn btn-xs  waves-effect btn-danger pull-right"><i class="material-icons">close</i></button><span><img class="img-responsive" src="' + data.src + '"></span></div>');

						$('<input>').attr('type','hidden')
							.attr('id','image-input-'+data.filename.slice(0,-4))
							.attr('name','image[]')
							.attr('value',data.filename)
							.appendTo('#result');
						$imageInput.val("");
    			},
    			error: function(){
    				console.log('failed');
    			},
    			complete: function(){
    				$('#ImageLoading').remove();
    				$saveButton.attr('disabled',false);
    			}
    		});
	}

	deleteImage = function(filename){
		$.ajax({
			url: "{{ url('admin/brands/delete-image')}}",
			type: 'DELETE',
			data:{location:storageLocation,
					filename:filename
				},
			success: function(){
			$('#image-input-'+filename.slice(0,-4)).remove();
			$('#image-preview-'+filename.slice(0,-4)).remove();
			},
			error: function(){
				console.log('failed');
			}
		});
	}
	  </script>



	  <!-- TinyMCE -->
	  <script src="{{url('assets/admin/plugins/tinymce/tinymce.js')}}"></script>
	  <script type="text/javascript">
	  $(function () {
	        //TinyMCE
	         tinymce.init({
	             selector: "textarea.htmlEditor",
	             menubar : false,
				 toolbar: 'bold italic link | bullist numlist | undo redo | code ',
				 // oninit : "setPlainText",
				 plugins:'- paste  - code  - link',
				 forced_root_block : false,
	             invalid_styles: 'color font-family font-size',
	             setup : function(ed)
	             {
	             	ed.on('init', function() 
	             	{
	             		// this.execCommand("fontName", false, "tahoma");
	             		this.execCommand("fontSize", false, "14px");
	             		if($(ed.targetElm).hasClass('arabic')){
	             			ed.getBody().dir = "rtl";
	             		}
	             	});
	             }  
	         });
	         tinymce.suffix = ".min";
	         tinyMCE.baseURL = '{{url('assets/admin/plugins/tinymce')}}'; 
	      
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

<script type="text/javascript">
//Activate current item in left side menu
// $(document).ready(function() {
// 	$(".menu .list li").removeClass('active');
// 	$("#mnu-brand").addClass('active').find('a').click();
// });
</script>


@endsection

