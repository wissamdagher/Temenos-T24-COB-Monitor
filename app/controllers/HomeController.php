<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function showHome()
	{
	  // Get last Cob in the system
      $max_date = Cob::max('cob_date');


      if(is_null($max_date))
      {
	$error_message = "System does not contain any COB date. Contact System Administrator";
		Log::error($error_message);

	return View::make('errors.show')
			->with(['error_message' =>$error_message]);
      }
		return View::make('reports.index')
				->with(['max_date' => $max_date]);
	}

	public function showCobs()
	{
		$max_date = Cob::max('cob_date');

		return View::make('reports.cobs')
				->with(['max_date' => $max_date]);
	}

	// handle multi cob display request
	public function showMultiCobs()
	{
		$max_date = Cob::max('cob_date');
		$min_date = Cob::min('cob_date');

		return View::make('reports.multicobs')
				->with(['max_date' => $max_date ,'min_date' => $min_date]);
	}

}
