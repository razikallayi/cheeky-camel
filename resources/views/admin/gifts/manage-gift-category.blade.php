@extends('admin.layout.app')

@section('title','Gift | Category ')

@section('active_menu','mnu-topss')
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
	@if(!$category->isEmpty())
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body table-wrapper">
				<table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable">
					@if(Session::has('fails'))
					<h4 style="color: red;">{{Session::get('fails')}}</h4>
					@endif
					<thead>
						<tr>

							<th>Category</th>

							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>


						@foreach($category as $i=>$cats)
						<tr>

							<td>{{$cats->category}}</td>

							<td><a href="{{url('admin/gift/category/edit/'.$cats->id)}}"><i class="material-icons">edit</i></a></td>
							<td width="5px"><a href="{{url('admin/gift/category/'.$cats->id)}}" onclick="event.preventDefault();
								document.getElementById('delete-form-{{$cats->id}}').submit();">
								<form id="delete-form-{{$cats->id}}" action="{{ url('admin/gift/category/'. $cats->id) }}" method="post" style="display: none;">
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
					<a href="{{url('admin/gift/add-category')}}" class="btn btn-info pull-right">Add Category</a>
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
    	//Make the dashboard widgets sortable Using jquery UI
    	// $(".connectedSortable").sortable({
    	// 	connectWith: ".connectedSortable",
    	// 	revert: 200,
    	// 	handle: ".card",
    	// 	zIndex: 999999
    	// });
    	// $(".connectedSortable .card").css("cursor", "move");
    	// $(".connectedSortable").on( "sortupdate", function( event, ui ) {
    	// 	var order = $(this).sortable("serialize") + '&action=updateCategoryListings'; 
    	// 	$.post("{{url('admin/cats/sort')}}", order)
    	// });
    </script> 
    {{--Sorting Ends--}}

    <script>
	// CSRF protection
	// $.ajaxSetup(
	// {
	// 	headers:
	// 	{
	// 		'X-CSRF-Token': $('input[name="_token"]').val()
	// 	}
	// });
</script>
@endsection