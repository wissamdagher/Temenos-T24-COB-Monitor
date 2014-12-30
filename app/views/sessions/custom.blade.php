@extends('layouts.sessions')
@section('main')
<style type="text/css">
.form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>
    <div class="row">
	<div class="col-sm-6 col-md-4 col-md-offset-4">
	    <h1 class="text-center login-title">Login to COB Dashboard</h1>
	    @if (Session::has('message'))
		<div class="alert alert-danger">
		       <a class="close" data-dismiss="alert" href="#">×</a>{{ Session::get('message') }}
		 </div>
	    @endif
	    <div class="account-wall">
		<img class="profile-img" src="/images/photo.png";
		    alt="">
		{{ Form::open(array('route' => 'sessions.store' , 'class' => 'form-signin', 'role' => 'form')) }}
		    <div class="form-group">
		{{ Form::text('email', '',array('class' => 'form-control','placeholder' => 'Email address', 'required', 'autofocus')) }}
		    </div>
		      <div class="form-group">
		{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) }}
	    </div>
	      <div class="form-group">
		{{ Form::submit('Sign in', ['class' => 'btn btn-lg btn-primary btn-block']) }}
	    </div>
		<a href="/password/remind" class="pull-left need-help">forgot password? </a><span class="clearfix"></span>
		{{ Form::close() }}
	    </div>
	</div>
    </div>
@stop

@section('footer')
    <script src="/js/vendor/jquery-1.11.0.js"></script>
	{{ HTML::script('/js/vendor/bootstrap.js') }}
	{{ HTML::script('vendor/bootstrapvalidator/js/bootstrapValidator.js') }}
	{{ HTML::script('vendor/moment/moment.js') }}
    <script type="text/javascript">
	$(document).ready(function() {
		$('.form-signin').bootstrapValidator({
		    live: 'disabled',
		    feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		    },
		    fields: {
			email: {
			    feedbackIcons: 'true',
			    validators: {
				notEmpty: {
				    message: 'Email can not be empty'
				},
				emailAddress: {
				    message: 'Enter your email'
				}
			    }
			},
			password: {
			    feedbackIcons: 'true',
			    validators: {
				notEmpty: {
				    message: 'Password can not be empty'
				}
			    }
			}
		    }
		});

});
</script>
@stop
