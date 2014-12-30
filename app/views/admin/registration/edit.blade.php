@extends('layouts.master')

@section('content')
    <div class="container">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		{{ Form::model($user,['method' => 'PUT', 'route' => array('register.update',$user->id), 'role' => 'form']) }}
			<legend>Update User Registration</legend>

				<div class="form-group">
				    {{  Form::label('username', 'Username:' ) }}
				    {{ Form::text('username', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
				    {{  Form::label('email', 'Email:' ) }}
				    {{ Form::email('email', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
				    {{  Form::label('role', 'Role:' ) }}
					{{ Form::select('role', $roles, $user->roles[0]->id ,['class' => 'form-control']) }}
				</div>

			<button type="submit" class="btn btn-primary">Submit</button>
			{{ Form::close() }}
	</div>

	</div>

@section('footer')

@stop
