<?php

class PasswordController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /password
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return View::make('account.password.change');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /password/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /password
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /password/{id}
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
	 * GET /password/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /password/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
			$message = '';
			$validator = Validator::make(Input::all(),
				array(
					'old_password' 		       => 'required',
					'password'	   	           => 'required|min:6',
					'password_confirmation'    => 'required|same:password')
				);
			if ($validator->fails()) {
				//Errors during validation
				return Redirect::route('change-password')
							->withErrors($validator);
			} else {
				//change Password
				$user 		  = User::find(Auth::id());

				$old_password = Input::get('old_password');
				$password  	  = Input::get('password');
					try {
							$valid = Auth::validate([
									'email' => $user->email ,
									'password' => $old_password
													]);
							$valid = true;

					} catch ( Toddish\Verify\UserPasswordIncorrectException $e) {
							$valid = false;
							$message = 'Old password error';
					}
					catch ( Toddish\Verify\UserUnverifiedException $e) {
							$valid = true;
					}

						if ($valid)
						{
							// Validation successfull change password
								$user->password = $password;
								$user->verified = 1;
								$user->save();
								return Redirect::to('/')
									->with('global', 'Your password has been chnaged');
						}

					}

		return Redirect::route('first_logon')
				->with('global', $message);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /password/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}