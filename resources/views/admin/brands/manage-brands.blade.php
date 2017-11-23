@extends('admin.layout.app')

@section('title','Brand | Manage')

@section('active_menu','mnu-brands')
@section('active_submenu','manage')

@section('styles')
@parent
<link href="{{url('assets/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- jquery sortable Plugin Css -->
<link href="{{url('assets/admin/plugins/jquery-sortable/jquery-sortable.min.css')}}" rel="stylesheet">

@endsection

@section('page_navigation')

@endsection

@section('content')


<div class="row">
	@if(!$brands->isEmpty())
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body table-wrapper">
				<table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable">
					<thead>
						<tr>
							<th>Logo</th>
							<th>Title</th>
							<th>Discription</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>


						@foreach($brands as $i=>$brand)
						<tr>
							<td>
							<img src="{{url('uploads/brands/'.$brand->logo)}}" width="90" height="90">
								
							</td>
							<td>{{$brand->title}}</td>
							<td>{{$brand->description}}</td>
							<td><a href="{{url('admin/brand/edit/'.$brand->id)}}"><i class="material-icons">edit</i></a></td>
							<td width="5px"><a href="{{url('admin/brand/'.$brand->id)}}" onclick="event.preventDefault();
								document.getElementById('delete-form-{{$brand->id}}').submit();">
								<form id="delete-form-{{$brand->id}}" action="{{ url('admin/brand/'. $brand->id) }}" method="post" style="display: none;">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
								</form><i class="material-icons">delete</i></a></td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="body">
					No data to display.
					<a href="{{url('admin/brands')}}" class="btn btn-info pull-right">Add Brand</a>
				</div>
			</div>
		</div>
		@endif
	</div>

	@endsection


	@section('scripts')
	@parent
	<!-- Jquery sortable Plugin Js -->
	<script src="{{url('assets/admin/plugins/jquery-sortable/jquery-sortable.min.js')}}"></script>
	<script type="text/javascript">
//Activate current item in left side menu
// $(document).ready(function() {
// 	$(".menu .list li").removeClass('active');
// 	$("#mnu-brand").addClass('active').find('a').click();
// });
</script>
    {{--Sorting Ends--}}

    <script>
	// CSRF protection
	$.ajaxSetup(
	{
		headers:
		{
			'X-CSRF-Token': $('input[name="_token"]').val()
		}
	});
</script>
@endsection