@extends('layouts.master')

@section('content')
    <div class="container">
	<div class="row">
    <h1>Daily Reports</h1>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="panel panel-default">
	<div class="panel-heading">
	    <h3 class="panel-title">COB ({{ $cob_dates[0] }}) vs COB ({{ $cob_dates[1] }})</h3>
	  </div>
	<div class="panel-body">
	  <div class="labeled-line-container">
	      <div class="canvas-holder">
	  <canvas id="daily-reports" width="900" height="360"></canvas>
	      </div>
	  </div>
	</div>
      </div>
     </div>
    </div>



    <h2>Drill Down</h2>
	<div class="row">
	    <div class=" col-md-6">
	    <div class = "panel panel-default">
	    <div class="panel-heading">
	    <strong> COB of {{ $cob_dates[0] }}</strong></span></div>
    @foreach ($totals as $index => $dailyIncome)
	<li  class="list-group-item"><strong>{{ $dates[$index] }}</strong> {{ $dailyIncome}} min</li>
    @endforeach
	</div>
	</div>
	    <div class=" col-md-6">
	    <div class = "panel panel-default">
	    <div class="panel-heading">
		<strong> COB of {{ $cob_dates[1] }}</strong></span></div>
     @foreach ($totals2 as $index => $dailyIncome)
	<li class="list-group-item"><strong>{{ $dates[$index] }}</strong> {{ $dailyIncome}} min</li>
    @endforeach
	</div>
	</div>
</div>
</div>
@stop

@section('footer')
    <script src="/js/vendor/Chart.js"></script>

    <script>
	(function() {
	    var canvas = document.getElementById('daily-reports');
	    var ctx = document.getElementById('daily-reports').getContext('2d');
	    var chart = {
		labels: {{ json_encode($dates) }},
		datasets: [{
		    data: {{ json_encode($totals) }},
		    fillColor : "rgba(220,220,220,0.5)",
		    strokeColor : "rgba(220,220,220,1)",
		    pointColor : "rgba(220,220,220,1)",
		    pointStrokeColor : "#fff",
		    label: '{{ $cob_dates[0] }}'
		},
		{
		    data: {{ json_encode($totals2) }},
		    fillColor : "rgba(151,187,205,0.5)",
		    strokeColor : "rgba(151,187,205,1)",
		    pointColor : "rgba(151,187,205,1)",
		    pointStrokeColor : "#fff",
		    label: '{{ $cob_dates[1] }}'
		}]
	    };



	var moduleDoughnut = new Chart(ctx).Line(chart, { bezierCurve: false });
	var legendHolder = document.createElement('div');
	 helpers = Chart.helpers;

	legendHolder.innerHTML = moduleDoughnut.generateLegend();
	// Include a html legend template after the module doughnut itself
	helpers.each(legendHolder.firstChild.childNodes, function(legendNode, index){
	    helpers.addEvent(legendNode, 'mouseover', function(){

	    });
	});
	helpers.addEvent(legendHolder.firstChild, 'mouseout', function(){
	    moduleDoughnut.draw();
	});
	canvas.parentNode.parentNode.appendChild(legendHolder.firstChild);


	})();
    </script>
@stop
