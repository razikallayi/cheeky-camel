@extends('admin.layout.app')

@section('title','Event')

@section('active_menu','mnu-event')
{{-- @section('active_submenu','add') --}}


@section('styles')
@parent
<link rel='stylesheet' href="{{url('assets/admin/css/fullcalendar.css')}}" />
<link href="{{url('assets/admin/css/fullcalendar.min.css')}}" rel='stylesheet' />

<!-- Bootstrap Material Datetime Picker Css -->
<link href="{{url('assets/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />


@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="body">
			{!! $calendar->calendar() !!}
		</div>
	</div>
</div>


  <div id="EventDetailsModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
    <div class="modal-content">
            <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Event Details</h4>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
      


  <div id="createEventModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <form action="{{url('admin/event/add')}}" method="post">
        {!! csrf_field() !!}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create Event</h4>
        </div>
        <div class="modal-body">
              <div class="form-group">
                <label>Event Name : </label>
                <input name="title" type="text" value="" class="form-control" placeholder="Event Name" required autofocus>
              </div>
              <div class="row">
                <div class="form-group col-sm-6 ">
                  <label>Start Date : </label>
                  <input type="text" class="form-control datepicker " name="start_date" id="start_date" placeholder="YYYY-MM-DD" >
                </div>
                <div class="form-group col-sm-6">
                  <label>End Date : </label>
                  <input required type="text" name="end_date" id="end_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                </div>

                <div class="form-group col-sm-6 hidden">
                  <label>Repeat every day: </label>
                  <input type="checkbox" name="repeat" class="form-control">
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <div class="pad">
            <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success">Create</button>
          </div>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

@endsection


@section('scripts')
@parent

<script src="{{url('assets/admin/js/jquery-ui.min.js')}}"></script>
<script src="{{url('assets/admin/js/moment.min.js')}}"></script>
<script src="{{url('assets/admin/js/fullcalendar.min.js')}}"></script>

{!! $calendar->script() !!}


<script type="text/javascript">
  pageObject = {};
   $(document).ready(function(){
      $('.modal').on('shown.bs.modal', function () {
        $(this).find('input:text:visible:first').focus();
      })
      
      $('.datepicker').bootstrapMaterialDatePicker({
      	format: 'YYYY-MM-DD',
      	weekStart: 1,
      	time: false
      });
    });

   pageObject.calendarEventClick = function(event,b,c){
    $('#EventDetailsModal .modal-body').html("<p>Title:"+event.title+"</p>");
    $('#EventDetailsModal .modal-footer').html(
        '<button type="submit" onClick="pageObject.deleteEvent('+event.id+')"  class="btn btn-sm pad btn-success">Delete</button>');
    $('#EventDetailsModal').modal();
   }

   pageObject.deleteEvent = function(event_id){
    if(confirm("Are you sure to delete?")){
      $.ajax({
        url     : "{{ url('admin/event/delete') }}",
        method  : 'post',
        data    : {
              id    : event_id,
              _token: "{!! csrf_token() !!}",
        },
        success: function( data ) {
          location.href = "{{url('admin/calendar')}}";
        }
      });
    }
   }

  </script>


  <!-- Bootstrap Material Datetime Picker Plugin Js -->
  <script src="{{url('assets/admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
@endsection


