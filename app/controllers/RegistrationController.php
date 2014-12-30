<?php

class RegistrationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /registration
	 *
	 * @return Response
	 */
	public function index()
	{
		//List all currently registered users
		$users = User::with('roles')->get();
		return View::make('admin.registration.index')
				->with(['users' => $users]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /registration/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// Display Registration Form
		//Get list of roles
		$roles = Role::lists('name','id');
		return View::make('admin.registration.create')
					->with(['roles' => $roles]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /registration
	 *
	 * @return Response
	 */
	public function store()
	{
		//get user input
		$email = Input::get('email');
		// Create a new User
		$user = new User;
		$user->username = Input::get('username');
		$user->email = $email;
		$user->password = Input::get('password'); // This is automatically salted and encrypted
		$user->verified = 0;
		$user->save();

		$role_id = Input::get('role');
		// Assign the Role to the User
		$user->roles()->sync(array($role_id));

		// Fire registration event
		$event = Event::fire('user.register', array($user));

		// Redirect to Home
		return Redirect::to('/')
			->with('message','User successfully created');
	}

	/**
	 * Display the specified resource.
	 * GET /registration/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /registration/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Modify Registered User information
		$user = User::with('roles')->findOrFail($id);
		$roles = Role::lists('name','id');

		return View::make('admin.registration.edit')
			->with(['user' => $user ,'roles' => $roles]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /registration/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		$email = Input::get('email');
		$user->username = Input::get('username');
		$user->email = $email;
		$user->password = Input::get('password'); // This is automatically salted and encrypted
		if ($user->update())
		{
			$role_id = Input::get('role');
			// Assign the Role to the User
			$user->roles()->sync(array($role_id));
			return Redirect::route('registered_users');
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /registration/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$loggedUser_id = Auth::id();
		if ($id != $loggedUser_id) {
			$user = User::find($id);
			$user->delete();
			return Redirect::route('registered_users');
		}
		else
		{
			return Redirect::route('registered_users')
					->with('global', 'Cannot delete same user');
		}


	}

}