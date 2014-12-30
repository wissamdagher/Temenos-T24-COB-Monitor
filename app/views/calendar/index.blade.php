@extends('layouts.master')

@section('content')
    {{ HTML::style('css/fullcalendar.css') }}
    {{ HTML::script('js/vendor/jquery-1.11.0.js') }}
    {{ HTML::script('js/vendor/fullcalendar.js') }}
<style type="text/css">
    .fc-holiday {
	background-color: red;
	border-color: red;
    }
</style>
    <div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-md-offset-2">
		<div id='calendar' style="height: 300px;"></div>
	</div>
    </div>
@stop

@section('footer')
    <script type="text/javascript">
	    $(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
	// put your options and callbacks here
	    header: {
		left: "month, agendaWeek, agendaDay",
		center: "title",
		right: "prev, next, today"
	    },

	    weekends: true,
	    aspectRatio: 1.7,
	    events: [
	@foreach ($cob_dates as $cob_date)
		{
		    title: 'COB',
		    start: '{{ $cob_date }}',
		    url: '/dashboard/{{$cob_date}}'
		},
	@endforeach
	@foreach ($holiday_dates as $holiday)
		{
		    title: 'Holiday',
		    start: '{{ $holiday }}',
		    className: 'fc-holiday'
		},
	@endforeach
    ],
    color: 'yellow',   // an option!
    textColor: 'black' // an option!

				 })

    });

    </script>

@stop
