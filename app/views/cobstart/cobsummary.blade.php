@if (isset($cobstartsummaries))
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					  <div class="panel-heading">
							<h3 class="panel-title">COB summary</h3>
					  </div>
						<table class="table table-bordered table-hover" id="cobstartsummaries">
							<thead>
								<tr>
									<th>COB Date</th>
									<th>Start Time</th>
									<th>End Time</th>
									<th>Duration</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($cobstartsummaries as $cobstartsummary)
										<tr>
											<td>{{ $cobstartsummary->cob_date }}</td>
											<td>{{ $cobstartsummary->cob_start_time }}</td>
											<td>{{ $cobstartsummary->cob_end_time }}</td>
											<td>{{ $cobstartsummary->cob_duration }}</td>
										</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
@endif
