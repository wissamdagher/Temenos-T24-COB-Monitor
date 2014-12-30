@extends('layouts.master')

@section('content')
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Top duration batches</div>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Company</th>
      <th>Batch ID</th>
      <th>Job Duration</th>
    </tr>
  </thead>
  <tbody>
    <?php
	    $row = 1;
	    foreach ($batches AS $batch) {
		$class = ($row % 2 == 0) ? 'info' : 'active';
		echo '<tr class="' . $class . '">';
		echo "<td>{$row}</td>";
		echo "<td>{$batch->company}</td>";
		echo "<td>{$batch->batch_id}</td>";
		echo "<td>{$batch->job_duration}</td>";
		echo '</tr>';
		$row++;
	    }
    ?>
  </tbody>
</table>
</div>
@stop

@section('footer')
    <script src="/js/vendor/jquery-1.11.0.js"></script>
    <script src="/js/vendor/chart.min.js"></script>
@stop