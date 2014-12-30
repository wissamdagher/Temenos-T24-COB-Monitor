@extends('layouts.master')

@section('content')
    <div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1>Daily Cob Reports</h1>
	</div>
    </div>
    <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	      <div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Stage times</h3>
		  </div>
		  <div class="panel-body">
	    <div class="labeled-chart-container">
			  <div class="canvas-holder">
			    <canvas id="daily-reports" width="1024" height="660"></canvas>
			    </div>
			</div>
		    </div>
		</div>
	    </div>

    </div>

    <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    <h2>Drill Down</h2>
	    </div>
    </div>
	<?php $counter = 0; ?>
    @foreach ($allcobs as $cob_date => $cob)
	@if ($counter % 3 == 0)
	<div class="row">
	@endif
	<div class=" col-md-4">
	    <div class = "panel panel-default">
	    <div class="panel-heading">
		<strong> COB of {{ $cob_date }}</strong></span></div>
		@foreach ($cob as $index => $duration)
		<?php
		$array = array_only($stages_avg,$dates[$index]);
		$stage_avg_sec = $array[$dates[$index]];
		$stage_avg = gmdate('H:i:s', $stage_avg_sec);
		$class = ( $duration <= $stage_avg_sec) ? 'label-primary' : 'label-danger';
		?>
		  <li class="list-group-item"><strong>{{ $dates[$index] }}</strong>
		    <span class="label {{ $class }}">{{ $duration}} min</span></li>
		@endforeach
	    </ul>
	</div>
	</div>
	@if (($counter + 1) % 3 == 0)
	    </div>
	@endif
	<?php $counter++; ?>
    @endforeach
	@if (($counter + 1) % 3 == 0)
	    </div>
	@endif
@stop

@section('footer')
    <script src="/js/vendor/Chart.js"></script>
    <script>
	(function() {
	    var canvas = document.getElementById('daily-reports');
	    var ctx = document.getElementById('daily-reports').getContext('2d');

	    var chart = {
		labels: {{ json_encode($dates) }},
		datasets: [
		//create datasets
		@foreach ($allcobs as $cob_date => $cob)
			{
		    data: {{ json_encode($cob) }},
		    fillColor : "rgba("+Math.floor((Math.random() * 255) + 1)+","+Math.floor((Math.random() * 255) + 1)+","+Math.floor((Math.random() * 255) + 1)+",0.5)",
		    strokeColor : "rgba(220,220,220,1)",
		    pointColor : "rgba(220,220,220,1)",
		    pointStrokeColor : "#fff",
		    label: '{{ $cob_date }}',
			},
		@endforeach
		]
	    };

	     var moduleDoughnut = new Chart(ctx).Bar(chart, { bezierCurve: false });
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
