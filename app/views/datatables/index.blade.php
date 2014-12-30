<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<title>DataTables Bootstrap 3 example</title>

		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">

		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10-dev/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#batches').dataTable({
					"pageLength": 50,
					"info": false
				});

			} );
		</script>
	</head>
	<body>
		<div class="container">
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
		@foreach ($batches_a as $batch_a)
		<tr>
			<td>{{ $batch_a->company }}</td>
			<td>{{ $batch_a->job_name }}</td>
			<td>{{ $batch_a->start_time }}</td>
			<td>{{ $batch_a->end_time }}</td>
			<td>{{ $batch_a->batch_stage }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

		</div>

<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#batches')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
</script>
	</body>
</html>