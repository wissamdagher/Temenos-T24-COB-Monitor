@extends('layouts.master')

@section('content')
    <div class="container">
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Username</th>
						<th>Email</th>
						<th>Verified</th>
						<th>Disabled</th>
						<th>Role</th>
						<th>Modify User</th>
						<th>Delete User</th>
					</tr>
				</thead>
				<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{ $user->username }}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->verified}}</td>
							<td>{{$user->disabled}}</td>
							<td>

									<ul class="list-group">
										@foreach ($user->roles as $role)
											<li class="list-group-item">{{ $role->name }}</li>
										@endforeach
									</ul>
							</td>
							<td>{{ link_to_route('register.edit','Edit', array($user->id), array('class' =>'btn btn-info')) }}
							</td>
							<td>
				    {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('register.destroy', $user->id))) }}
				    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
				    {{ Form::close() }}
							</td>
						</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>
	</div>

@section('footer')

@stop
