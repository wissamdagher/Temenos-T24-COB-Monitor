@extends('layouts.master');

@section('content')
	{{ Form::open() }}

	<div class="form-group">
	    {{  Form::label('email', 'Email:' ) }}
	    {{ Form::email('email', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
	    {{  Form::label('password', 'Password:' ) }}
	    {{ Form::password('password',['class' => 'form-control']) }}
	</div>

	<div class="form-group">
	    {{  Form::label('password_confirmation', 'Password confirm:' ) }}
	    {{ Form::password('password_confirmation',['class' => 'form-control']) }}
	</div>

  {{ Form::hidden('token', $token) }}

  <button type="submit" class="btn btn-primary">Submit</button>

{{ Form::close() }}

	@if (Session::has('error'))
		{{ Session::get('error') }}
	@elseif (Session::has('success'))
		Password was reset
	@endif

@stop
