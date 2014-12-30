@extends('layouts.master');
@section('content')
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
			@if (Session::has('error'))
				<div class="alert alert-danger" role="alert">
					{{ Session::get('error') }}
				</div>
			@elseif (Session::has('status'))
			<div class="alert alert-success" role="alert">An email with the password reset has been sent.</div>
			@endif
		<div id="form-olvidado">
	    <h4 class="">
	      Forgot your password?
	    </h4>
	    <form accept-charset="UTF-8" role="form" id="login-recordar" method="post">
	      <fieldset>
		<span class="help-block">
		  Email address you use to log in to your account
		  <br>
		  We'll send you an email reset your password.
		</span>
		<div class="form-group input-group">
		  <span class="input-group-addon">
		    @
		  </span>
		  <input class="form-control" placeholder="Email" name="email" type="email" required="">
		</div>
		<button type="submit" class="btn btn-primary btn-block" id="btn-olvidado">
		  Continue
		</button>
	      </fieldset>
	    </form>
	  </div>
	</div>


@stop
