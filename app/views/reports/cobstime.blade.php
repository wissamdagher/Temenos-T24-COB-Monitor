@extends('layouts.master')

@section('content')
  <div class="col-lg-12">
	    <div class="page-header">
	      <h1 id="forms">Select COB Dates to compare</h1>
	    </div>
	  </div>
    <?php
    $dt = new DateTime();
    ?>
    <div class="container">
      <div class="row">
      <div class="col-md-6">
	<div class="well bs-component">
      <form action="/cob_reports_all_time" method="POST" role="form" class="form-horizontal" id="cob_dates" name="cob_dates">
	<fieldset>
      <legend>Select Desired COB Dates</legend>

     <div class="form-group">
      <label for="start_date" class="col-lg-4 control-label">First COB Date</label>
      <div class="col-lg-8">
	<input class="form-control" id="start_date" placeholder="Date" type="text" name="cob_date1" value="{{ $dt->format('Y-m-d') }}" data-date-format="yyyy-mm-dd">
      </div>
    </div>

     <div class="form-group">
      <label for="end_date" class="col-lg-4 control-label">Last COB Date</label>
      <div class="col-lg-8">
	<input class="form-control" id="end_date" placeholder="Date" type="text" name="cob_date2" value="{{ $dt->format('Y-m-d') }}" data-date-format="yyyy-mm-dd">
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-4">
	<button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    </fieldset>
    </form>
  </div>
    </div>
    </div>
    </div>

@stop

@section('footer')
    <script src="/js/vendor/jquery-1.11.0.js"></script>
    <script src="/js/vendor/chart.min.js"></script>
    <script src="/js/vendor/bootstrap-datepicker.js"></script>
    <script>
    $(function(){
	$('#start_date').datepicker({
	format: 'yyyy-mm-dd'
	       });
	$('#end_date').datepicker({
	    format: 'yyyy-mm-dd'
	});
    });
    </script>
@stop
