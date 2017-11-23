@extends('admin.layout.app')

@section('title',' Users | Newsletter')

@section('active_menu','mnu-brands')
@section('active_submenu','add')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="card">
		<div class="body">
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
			<form id="form_validation" method="POST" action="{{url('admin/users/newsletter')}}" enctype="multipart/form-data">
				{{csrf_field()}}

				@if(Session::has('empty_email'))
				<h4 style="color: red;">{{Session::get('empty_email')}}</h4>
				@endif
				
				@if(Session::has('success_newsletter'))
				<h4 style="color: green;">{{Session::get('success_newsletter')}}</h4>
				@endif
				<h2 class="card-inside-title">Description</h2>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<textarea id="ckeditor"  name="description" required>{{old('description')}}</textarea>
							</div>
						</div>
					</div>
				</div>



				<div class="demo-checkbox">
				<input type="checkbox" name="users" id="md_checkbox_30"  class="filled-in chk-col-pink" value="1" />
					<label for="md_checkbox_30">All Subscribed Users</label>
				</div>



				
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="">
								<input type="submit" name="save" value="Send Newsletter" class="btn btn-success waves-effect" >
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


<script src="{{url('assets/admin/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
$(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
    });
</script>


@endsection