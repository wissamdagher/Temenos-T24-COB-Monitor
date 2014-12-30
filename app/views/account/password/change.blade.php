@extends('layouts.master')

@section('content')

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
	@if (Session::has('global'))
		<div class="alert alert-info">
		       <a class="close" data-dismiss="alert" href="#">×</a>{{ Session::get('global') }}
		 </div>
	@endif
	<div class="page-header">
	  <h1>Change Password</h1>
	</div>
	<div class="well">
       {{ Form::open(['name' => 'change_password_form' ,'id' => 'change_password_form']) }}

	 <div class="form-group">
	    {{  Form::label('old_password', 'Old Password:' ) }}
	    {{ Form::password('old_password',['class' => 'form-control']) }}
	    @if ($errors->has('old_password'))
		{{ $errors->first('old_password') }}
	    @endif
	</div>

	<div class="form-group">
	    {{  Form::label('password', 'Password:' ) }}
	    {{ Form::password('password',['class' => 'form-control' , 'required' => 'required' ]) }}
	    @if ($errors->has('password'))
		{{ $errors->first('password') }}
	    @endif
	</div>

	<div class="form-group">
	    {{  Form::label('password_confirmation', 'Password confirm:' ) }}
	    {{ Form::password('password_confirmation',['class' => 'form-control' , 'required' => 'required']) }}
	    @if ($errors->has('password_confirmation'))
		{{ $errors->first('password_confirmation') }}
	    @endif
	</div>

  {{ Form::token() }}

  <button type="submit" class="btn btn-primary">Submit</button>

{{ Form::close() }}

    @if (Session::has('error'))
	{{ Session::get('error') }}
    @elseif (Session::has('success'))
	Password was reset
    @endif
	</div>

</div>

@stop
@section('footer')
    <script src="/js/vendor/jquery-1.11.0.js"></script>
    <script src="/js/vendor/chart.min.js"></script>
    <script src="/js/vendor/bootstrap-datepicker.js"></script>
	{{ HTML::script('vendor/bootstrapvalidator/js/bootstrapValidator.js') }}
	{{ HTML::script('vendor/moment/moment.js') }}
    <script>
$(document).ready(function() {
    $('#change_password_form').bootstrapValidator({
	feedbackIcons: {
	    valid: 'glyphicon glyphicon-ok',
	    invalid: 'glyphicon glyphicon-remove',
	    validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
	    old_password: {
		feedbackIcons: 'true',
		validators: {
		    notEmpty: {
			message: 'Please enter your Old password'
		    },
		    stringLength: {
			min: 6,
			message: 'Old Password should be a minimum of 6 characters'
		    }
		}
	    },
	    password: {
		feedbackIcons: 'true',
		validators: {
		    notEmpty: {
			message: 'Please enter your password'
		    },
		    stringLength: {
			min: 6,
			message: 'Password should be a minimum of 6 characters'
		    }
		}
	    },
	    password_confirmation: {
		feedbackIcons: 'true',
		validators: {
		    notEmpty: {
			message: 'Please confirm your password'
		    },
		    callback: {
			message: 'Passwords did not match',
			callback: function(value, validator) {
			    var password = $('#password').val();
			    var confirm_password = value;
			    if (!(confirm_password == password)) {
				return false;
			    }
			    return true;
			}
		}
	    }
	    }
	}
    });
});


    </script>
@stop
