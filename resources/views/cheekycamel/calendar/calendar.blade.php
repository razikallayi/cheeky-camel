@extends('layouts.cheeky-camel-master')
@section('title','Cheeky Camel')

@section('styles')
@parent
<link href="{{url('assets/cheekycamel/css/fullcalendar.min.css')}}" rel='stylesheet' />
<style>
.fc-toolbar.fc-header-toolbar{
    background: #f1b036;
    padding: 10px 10px 0px 10px;
}

</style>
@endsection


@section('content')
@include('layouts.partials.header')


<div class="abt-tp">
  <div class="container">
   <div class="col-md-12 no-padding">
    <div class="abt-hd">
      <h2>My Calendar</h2>
      <div class="breadcrumb">
        <ul>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>My Calendar</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>


<div class="cart-sec">
	<div class="container">
		<div class="col-md-12 no-padding">
			<div class="cart-main clearfix">
				{!! $calendar->calendar() !!}
			</div>
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


@include('layouts.partials.footer')
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
    });

   pageObject.calendarEventClick = function(event,b,c){
    $('#EventDetailsModal .modal-body').html("<p>Title:"+event.title+"</p>");
    $('#EventDetailsModal').modal();
   }



/*


   $('#exampleModal').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget) // Button that triggered the modal
     var recipient = button.data('whatever') // Extract info from data-* attributes
     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
     var modal = $(this)
     modal.find('.modal-title').text('New message to ' + recipient)
     modal.find('.modal-body input').val(recipient)
   })
*/
  </script>


<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
@endsection







