@extends('admin.layout.app')

@section('title','Console | Manage ')

@section('active_menu','mnu-cast')
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
	@if(!$consoles->isEmpty())
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
							<th>Quantity</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>


						@foreach($consoles as $console)
						<tr>

							@if($console->images()->first() != null || $console->images()->first() != "")
							<td><img src="{{url('uploads/console/'.$console->images()->first()->images)}}" width="90" height="90"></td>
							@else
							<td><img src="" alt="no-image" width="90" height="90"></td>
							@endif
						
						
							<td>{{$console->title}}</td>
							<td>{{$console->category()->first()->category}}</td>
							<td>{{$console->description}}</td>
							<td>{{$console->quantity}}</td>
							<td>{{$console->price}}</td>
							<td>{{$console->discount}}</td>

							<td><a href="{{url('admin/console/edit/'.$console->id)}}"><i class="material-icons">edit</i></a></td>
							<td width="5px"><a href="{{url('admin/console/'.$console->id)}}" onclick="event.preventDefault();
								document.getElementById('delete-form-{{$console->id}}').submit();">
								<form id="delete-form-{{$console->id}}" action="{{ url('admin/console/'. $console->id) }}" method="post" style="display: none;">
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
					<a href="{{url('admin/console')}}" class="btn btn-info pull-right">Add Console</a>
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
	
    {{--Sorting Ends--}}

    
    @endsection