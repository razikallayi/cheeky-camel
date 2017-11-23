@extends('admin.layout.app')

@section('title','TableTop | Manage ')

@section('active_menu','mnu-tossp')
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
	@if(!$shops->isEmpty())
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body table-wrapper">
				<table class="table table-bordered table-responsive table-striped table-hover js-basic-example dataTable">
					<thead>
						<tr>

							<th>Image</th>
							<th>Item</th>
							<th>Category</th>
							<th>Description</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>


						@foreach($shops as $shop)
						<tr>

							
							@if($shop->images()->first() != "" || $shop->images()->first() != null)
							<td><img src="{{url('uploads/shops/'.$shop->images()->first()->images)}}" width="90" height="90"></td>
							@else
							<td><img src="" width="90" alt="no-image" height="90"></td>
							@endif
							
							

							<td>{{$shop->title}}</td>
							<td>{{$shop->category()->first()->category}}</td>
							<td>{{$shop->description}}</td>
							<td>{{$shop->price}}</td>
							<td>{{$shop->discount}}</td>

							<td><a href="{{url('admin/shops/edit/'.$shop->id)}}"><i class="material-icons">edit</i></a></td>
							<td width="5px"><a href="{{url('admin/shops/'.$shop->id)}}" onclick="event.preventDefault();
								document.getElementById('delete-form-{{$shop->id}}').submit();">
								<form id="delete-form-{{$shop->id}}" action="{{ url('admin/shops/'. $shop->id) }}" method="post" style="display: none;">
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
					<a href="{{url('admin/shop')}}" class="btn btn-info pull-right">Add TableTop</a>
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

    
    @endsection