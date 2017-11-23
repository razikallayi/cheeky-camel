@extends('admin.layout.app')

@section('title','Apparels | Category')

@section('active_menu','mnu-news')


@section('content')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">

				<form id="form_validation" method="POST" action="{{url('admin/apparels/category/edit/'.$category->id)}}" enctype="multipart/form-data">
					{{csrf_field()}}
					{{ method_field('PUT') }}

					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					<input type="hidden" name="id" value="{{$category->id}}">

					<div class="row clearfix">
						<div class="col-sm-6">
							<label>Category</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" value="{{$category->category}}" name="category" class="form-control" required="">
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
</div>

@endsection



@section('scripts')
@parent




<!-- TinyMCE -->
<script src="{{url('md/plugins/tinymce/tinymce.js')}}"></script>
<script type="text/javascript">
  		// $(function () {
    // 	        //TinyMCE
    // 	        tinymce.init({
    // 	        	selector: "textarea.htmlEditor",
    // 	        	menubar : false,
    // 	        	toolbar: 'bold italic link | bullist numlist | undo redo | code ',
    // 				 // oninit : "setPlainText",
    // 				 plugins:'- paste  - code  - link',
    // 				 forced_root_block : false,
    // 				 invalid_styles: 'color font-family font-size',
    // 				 setup : function(ed)
    // 				 {
    // 				 	ed.on('init', function() 
    // 				 	{
    // 	             		// this.execCommand("fontName", false, "tahoma");
    // 	             		this.execCommand("fontSize", false, "14px");
    // 	             		if($(ed.targetElm).hasClass('arabic')){
    // 	             			ed.getBody().dir = "rtl";
    // 	             		}
    // 	             	});
    // 				 }  
    // 				});
    // 	        tinymce.suffix = ".min";
    // 	        tinyMCE.baseURL = '{{url('md/plugins/tinymce')}}'; 

    // 	    });
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

