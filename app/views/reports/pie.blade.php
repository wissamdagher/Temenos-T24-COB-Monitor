@extends('layouts.master')

@section('content')
<style type="text/css">

.easy-pie-chart{position:relative;width:110px;margin:0 auto;margin-bottom:15px;text-align:center}
.easy-pie-chart canvas{position:absolute;top:0;left:0}
.easy-pie-chart .percent{display:-moz-inline-stack;
    display:inline-block;
    vertical-align:middle;
    *vertical-align:auto;
    zoom:1;
    *display:inline;
    line-height:110px;z-index:2}
.easy-pie-chart .percent:after{content:'%';margin-left:0.1em;font-size:.8em}

.content-wrapper {
  background-color: #F1F1F1;
}

canvas {
	    width: 100% !important;
	    max-width: 800px;
	    height: auto !important;
}

</style>
    {{ HTML::script('js/vendor/jquery.dataTables.min.js') }}
    {{ HTML::script('js/vendor/dataTables.bootstrap.js') }}
    <script type="text/javascript">
	$(document).ready(function() {
	$('#batches').dataTable({
	  "pageLength": 25,
	  "info": false
	});
	$('#reports').dataTable({
	  "pageLength": 100,
	  "info": false
	});
	});

    </script>
<div class="page-header">
  <h1>COB Dashboard <small>{{ $cob_today_date }}</small></h1>
</div>

<div class="container">
  <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-md-offset-1">
   <?php
	    $row = 1;
	    $class = '';
	    $percent = 0;
	    foreach ($cob_stages AS $stage) {
		$array = array_only($stages_avg,$stage->stage_name);
		$stage_avg_sec = $array[$stage->stage_name];
		$stage_avg = gmdate('H:i:s', $stage_avg_sec);
		$class = ($stage->stg_duration_sec <= $stage_avg_sec) ? 'green' : 'red';
		$percent = ($stage->stg_duration_sec <= $stage_avg_sec) ? (int)((($stage_avg_sec - $stage->stg_duration_sec)*100) / $stage_avg_sec) : (int)((($stage->stg_duration_sec - $stage_avg_sec)*100) / $stage_avg_sec);
  ?>
		<div class="col-md-2">
		      <div class="easy-pie-chart {{$class}}" data-percent="{{$percent}}">
			      <span class="percent">{{$percent}}</span>
			    </div>
			    <p class="text-center">{{$stage->stage_name}}</p>
		</div>
<?php
		$row++;
	    }
  ?>
</div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="panel panel-default">
	<div class="panel-heading">
	    <h3 class="panel-title">COB ({{ $cob_today_date }}) vs D-1 ({{ $cob_day_before_date }})</h3>
	  </div>
	<div class="panel-body">
	  <div class="labeled-line-container">
	      <div class="canvas-holder">
		    <canvas id="today_vs_yesterday" width="550" height="300"></canvas>
	      </div>
	  </div>
	</div>
      </div>
     </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">COB ({{ $cob_today_date }}) vs last week ({{ $cob_week_before_date }})</h3>
	  </div>
	  <div class="panel-body">
	    <div class="labeled-line-container">
	      <div class="canvas-holder">
	    <canvas id="today_vs_week" width="550" height="300"></canvas>
	  </div>
	</div>
	  </div>
      </div>
     </div>
  </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">COB ({{ $cob_today_date }}) vs Month before ({{ $cob_month_before_date }}) </h3>
	  </div>
	  <div class="panel-body">
	    <div class="labeled-line-container">
	      <div class="canvas-holder">
		  <canvas id="today_vs_month" width="600" height="300"></canvas>
	      </div>
	    </div>
	  </div>
      </div>
     </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Cob time</h3>
	  </div>
	  <div class="panel-body">
		  <canvas id="cob_summary_graph" width="600" height="300"></canvas>
	  </div>
      </div>
  </div>
</div>
</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Stage Time for <strong>{{$batch_date}}</strong>
    <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel-times">
  <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
</div>
  <div class="panel-body collapse" id="panel-times">
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Stage Name</th>
      <th>Batch date</th>
      <th>Stage Duration</th>
      <th>Average Time</th>
      <th>Time D-1</th>
      <th>Time Week Ago</th>
      <th>Time month Ago</th>
    </tr>
  </thead>
  <tbody>
   <?php


	     $row = 1;
	     $class = '';
	     $index = 0;
	    foreach ($cob_stages AS $stage) {
		$array = array_only($stages_avg,$stage->stage_name);
		$stage_avg_sec = $array[$stage->stage_name];
		$stage_avg = gmdate('H:i:s', $stage_avg_sec);
		$class = ($stage->stg_duration_sec <= $stage_avg_sec) ? 'success' : 'danger';
		echo '<tr class="' . $class . '">';
		echo "<td>{$row}</td>";
		echo "<td>{$stage->stage_name}</td>";
		echo "<td>{$stage->stg_batch_date}</td>";
		echo "<td>{$stage->stg_duration}</td>";
		echo "<td>{$stage_avg}</td>";
		echo "<td>".gmdate('H:i:s',($cob_day_before[$index]*60))."</td>";
		echo "<td>".gmdate('H:i:s',($cob_week_before[$index]*60))."</td>";
		echo "<td>".gmdate('H:i:s',($cob_month_before[$index]*60))."</td>";
		echo '</tr>';
		$row++;
		$index++;
	    }
    ?>
  </tbody>
</table>
</div>
</div>
 </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="panel panel-default" >
  <!-- Default panel contents -->
  <div class="panel-heading">JOB Times for <strong>{{$batch_date}}</strong>
	<button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel-batches">
	  <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  </div>
  <div class="panel-body collapse" id="panel-batches">
<table id="batches" class="display" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Company</th>
      <th>Job Name</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Batch Stage</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($batches as $batch)
    <tr>
      <td>{{ $batch->company }}</td>
      <td>{{ $batch->job_name }}</td>
      <td>{{ $batch->start_time }}</td>
      <td>{{ $batch->end_time }}</td>
      <td>{{ $batch->batch_stage }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Reports for <strong>{{$batch_date}}</strong>
	<button type="button" class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#panel-reports">
  <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  </div>
    <div class="panel-body collapse" id="panel-reports">
<table id="reports" class="display" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Company</th>
      <th>Batch Name</th>
      <th>Report Type</th>
      <th>Report Name</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Duration</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($reports as $report)
    <tr>
      <td>{{ $report->company }}</td>
      <td>{{ $report->batch_name }}</td>
      <td>{{ $report->report_type }}</td>
      <td>{{ $report->report_name }}</td>
      <td>{{ $report->start_time }}</td>
      <td>{{ $report->end_time }}</td>
      <td>{{ $report->elapsed_time }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>

@stop

@section('footer')
    {{ HTML::script('js/vendor/jquery.easypiechart.js') }}
    {{ HTML::script('js/vendor/Chart.js') }}
    <script>
    $(function() {
	$('.green').easyPieChart({
	    //your options goes here
	    barColor: "#3E9C1A",
	    trackColor: "#ccc",
	    scaleLength: 5,
	    scaleColor: "#ddd",
	    lineWidth: 5,
	    lineCap: "square",
	    animate: 3000
	});

	$('.red').easyPieChart({
	    //your options goes here
	    barColor: "#E60404"
	});
    });

    $('#batches')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');

    $('#reports')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
    <script>
	(function() {
	    var canvas = document.getElementById('today_vs_yesterday');
	    var ctx = document.getElementById('today_vs_yesterday').getContext('2d');
	    var chart = {
		labels: {{ json_encode($stages_name) }},
		datasets: [{
		    data: {{ json_encode($cob_today) }},
		    fillColor : "rgba(220,220,220,0.5)",
		    strokeColor : "rgba(220,220,220,1)",
		    pointColor : "rgba(220,220,220,1)",
		    pointStrokeColor : "#fff",
		    label:'Today'
		},
		{
		    data: {{ json_encode($cob_day_before) }},
		    fillColor : "rgba(151,187,205,0.5)",
		    strokeColor : "rgba(151,187,205,1)",
		    pointColor : "rgba(151,187,205,1)",
		    pointStrokeColor : "#fff",
		    label: 'D-1'
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
    <script>
	(function() {
	    var canvas = document.getElementById('today_vs_week');
	    var ctx = document.getElementById('today_vs_week').getContext('2d');
	    var chart = {
		labels: {{ json_encode($stages_name) }},
		datasets: [{
		    data: {{ json_encode($cob_today) }},
		    fillColor : "rgba(220,220,220,0.5)",
		    strokeColor : "rgba(220,220,220,1)",
		    pointColor : "rgba(220,220,220,1)",
		    pointStrokeColor : "#fff",
		    label: 'Today'
		},
		{
		    data: {{ json_encode($cob_week_before) }},
		    fillColor : "rgba(151,187,205,0.5)",
		    strokeColor : "rgba(151,187,205,1)",
		    pointColor : "rgba(151,187,205,1)",
		    pointStrokeColor : "#fff",
		    label: 'Last Week'
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
    <script>
	(function() {
	   var canvas = document.getElementById('today_vs_month');
	    var ctx = document.getElementById('today_vs_month').getContext('2d');
	    var chart = {
		labels: {{ json_encode($stages_name) }},
		datasets: [{
		    data: {{ json_encode($cob_today) }},
		    fillColor : "rgba(220,220,220,0.5)",
		    strokeColor : "rgba(220,220,220,1)",
		    pointColor : "rgba(220,220,220,1)",
		    pointStrokeColor : "#fff",
		    label: 'Today'
		},
		{
		    data: {{ json_encode($cob_month_before) }},
		    fillColor : "rgba(151,187,205,0.5)",
		    strokeColor : "rgba(151,187,205,1)",
		    pointColor : "rgba(151,187,205,1)",
		    pointStrokeColor : "#fff",
		    label: 'Last Month'
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
    <script>
	(function() {
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
		}]
	    };

	    new Chart(ctx).Bar(chart, { bezierCurve: false });
	})();
    </script>
@stop
