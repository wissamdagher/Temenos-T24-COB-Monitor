@extends('layouts.master')
@section('content')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-md-offset-2">
			<div class="panel panel-danger">
				  <div class="panel-heading">
						<h3 class="panel-title">Error</h3>
				  </div>
				  <div class="panel-body">
						{{ $error_message }}
				  </div>
			</div>
		</div>
	</div>
@stop
@section('footer')
	{{-- expr --}}
@stop