@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Cob time</h3>
	  </div>
	  <div class="panel-body">
	    <div class="labeled-chart-container">
		  <div class="canvas-holder">
			<canvas id="cob_summary_graph" width="800" height="300"></canvas>
		</div>
	    </div>
	  </div>
      </div>
    </div>
</div>

    <h2>Drill Down</h2>

    <div class="container">
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
    </div>
@stop

@section('footer')
    <script src="/js/vendor/chart.js"></script>
     <script>
	(function() {
	    var canvas = document.getElementById('cob_summary_graph');
	    var ctx = document.getElementById('cob_summary_graph').getContext('2d');
	    var chart = {
		labels: {{ json_encode($cob_dates) }},
		datasets: [
		{
		    data: {{ json_encode($cob_times) }},
		    fillColor : "rgba(220,220,220,0.5)",
		    strokeColor : "rgba(220,220,220,1)",
		    pointColor : "rgba(220,220,220,1)",
		    pointStrokeColor : "#fff",
		    label: "wissam",
		}]
	    };

	    var options = {
			    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			    scaleBeginAtZero : true,

			    //Boolean - Whether grid lines are shown across the chart
			    scaleShowGridLines : true,

			    //String - Colour of the grid lines
			    scaleGridLineColor : "rgba(0,0,0,.05)",

			    //Number - Width of the grid lines
			    scaleGridLineWidth : 1,

			    //Boolean - If there is a stroke on each bar
			    barShowStroke : true,

			    //Number - Pixel width of the bar stroke
			    barStrokeWidth : 2,

			    //Number - Spacing between each of the X value sets
			    barValueSpacing : 5,

			    //Number - Spacing between data sets within X values
			    barDatasetSpacing : 1,

			    bezierCurve: false,

			    //String - A legend template
			    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

			};


	   var moduleDoughnut = new Chart(ctx).Bar(chart, options);


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
