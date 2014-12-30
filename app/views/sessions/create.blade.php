@extends('layouts.sessions')
@section('main')
{{ Form::open(array('route' => 'sessions.store' , 'class' => 'form-signin', 'role' => 'form')) }}
<h2 class="form-signin-heading">Please sign in</h2>

			{{ Form::text('email', '',array('class' => 'form-control','placeholder' => 'Email address', 'required', 'autofocus')) }}

			{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) }}
			{{ Form::submit('Sign in', ['class' => 'btn btn-lg btn-primary btn-block']) }}

{{ Form::close() }}
@stop