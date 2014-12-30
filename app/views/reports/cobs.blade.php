@extends('layouts.master')

@section('content')
  <div class="col-lg-12">
	    <div class="page-header">
	      <h1 id="forms">Select COB Dates to compare <small> Last Cob date in the system {{ $max_date }}</small></h1>
	    </div>
	  </div>
    <?php
    $cob_date = Carbon::createFromFormat('Y-m-d', $max_date);
   //Carbon::setToStringFormat('Y-m-d');
   $cob_week_before = $cob_date->copy()->subWeek();
    ?>
    <div class="container">
      <div class="row">
      <div class="col-md-6">
	<div class="well bs-component">
      <form action="/cob_reports_all" method="POST" role="form" class="form-horizontal" id="cob_dates" name="cob_dates">
	<fieldset>
      <legend>Select Desired COB Dates</legend>

     <div class="form-group">
      <label for="start_date" class="col-lg-4 control-label">First COB Date</label>
      <div class="col-lg-8">
	<input class="form-control" id="start_date" placeholder="Date" type="text" name="cob_date1" value="{{ $cob_week_before->toDateString() }}" data-date-format="yyyy-mm-dd">
      </div>
    </div>

     <div class="form-group">
      <label for="end_date" class="col-lg-4 control-label">Last COB Date</label>
      <div class="col-lg-8">
	<input class="form-control" id="end_date" placeholder="Date" type="text" name="cob_date2" value="{{ $max_date }}" data-date-format="yyyy-mm-dd">
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
    <script src="/js/vendor/bootstrap-datepicker.js"></script>
	{{ HTML::script('vendor/bootstrapvalidator/js/bootstrapValidator.js') }}
	{{ HTML::script('vendor/moment/moment.js') }}
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
    <script type="text/javascript">

      $(document).ready(function() {
    $('#cob_dates').bootstrapValidator({
	feedbackIcons: {
	    valid: 'glyphicon glyphicon-ok',
	    invalid: 'glyphicon glyphicon-remove',
	    validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
	    cob_date1: {
		feedbackIcons: 'true',
		validators: {
		    notEmpty: {
			message: 'COB date can not be empty'
		    },
		    date: {
			format: 'YYYY-MM-DD',
			message: 'The value is not a valid date format'
		    },
		    callback: {
			message: 'First COB Date should be less than Max System Date',
			callback: function(value, validator) {
			    var dat1 = '{{ $max_date }}';
			    var m = new moment(value, 'YYYY-MM-DD', true);
			    // Check if the date in our range
			    return m.isBefore(dat1);
			}
		    }
		}
	    },
	    cob_date2: {
		feedbackIcons: 'true',
		validators: {
		    notEmpty: {
			message: 'COB date can not be empty'
		    },
		    date: {
			format: 'YYYY-MM-DD',
			message: 'The value is not a valid date format'
		    },
		    callback: {
			callback: function(value, validator) {
			    var dat1 = $('#start_date').val();
			    var max_date = '{{ $max_date }}';
			    var m = new moment(value, 'YYYY-MM-DD', true);
			    // Check if the date in our range
			    if(m.isAfter(max_date)) {
				return {
					    valid: false,    // or false
					    message: 'Second COB date should be less than Max System Date'
					}
			    } else {
			      if (m.isBefore(dat1) || m.isSame(dat1)){
				return {
					    valid: false,    // or false
					    message: 'Second COB date should be greater than First COB Date'
					}
			      }
			      return true;
			    }

			}
		    }
		}
	    }
	}
    });
    $('#start_date')
	.on('changeDate', function(ev){
	    // Validate the date when user change it
	    $('#cob_dates').bootstrapValidator('revalidateField', 'cob_date1');
	});

    $('#end_date')
	.on('changeDate', function(ev){
	    // Validate the date when user change it
	    $('#cob_dates').bootstrapValidator('revalidateField', 'cob_date2');
	});

});

    </script>
@stop
