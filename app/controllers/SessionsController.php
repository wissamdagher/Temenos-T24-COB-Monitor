<?php

class SessionsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	return View::make('sessions.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	return View::make('sessions.custom');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$input = Input::all();
		$verified = 1;

				try {
					$attempt = Auth::attempt(
						[
						'email' => $input['email'],
						'password' => $input['password']
						]);
					$attempt = true;
				}
				catch ( Toddish\Verify\UserPasswordIncorrectException $e )
				{
					$attempt = false;
					$message = 'Password Incorrect';
				}
				catch (Toddish\Verify\UserNotFoundException $e )
				{
					$attempt = false;
					$message = 'User Not Found';
				}
				catch (Toddish\Verify\UserUnverifiedException $e)
				{
					$attempt = true;
					$verified = 0;
					$message = 'User Not Verified';
					//dd($e);
				}

		if ($attempt) {
			if ($verified) {

					return Redirect::intended('/');

						} else
							{
									$user = User::where('email',$input['email'])->firstOrFail();
									Auth::login($user);
									//return 'chould be verified first';
									return Redirect::route('first_logon');
							}

			}
			else {
				return Redirect::to('/login')->with('message', $message );
			}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	return View::make('sessions.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	return View::make('sessions.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		//logout
		Auth::logout();
		return Redirect::to('/');
	}

}
