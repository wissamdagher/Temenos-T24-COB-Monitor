<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('first_logon', ['as' => 'first_logon', 'uses' => 'PasswordController@index']);

Route::post('first_logon', ['as' => 'first_logon', 'uses' => 'PasswordController@update']);

/*
|
| Register New Users
|
*/

Route::get('/register/list', ['as' =>'registered_users', 'uses' =>'RegistrationController@index'])->before('auth|admin');

Route::get('/register/{id}', ['as' =>'register.edit', 'uses' =>'RegistrationController@edit'])->before('auth|admin');

Route::put('/register/{id}', ['as' => 'register.update', 'uses' => 'RegistrationController@update'])->before('auth|admin');

Route::delete('/register/{id}',['as' => 'register.destroy', 'uses' => 'RegistrationController@destroy'])->before('auth|admin');

Route::get('register',['as' =>'register_path', 'uses' => 'RegistrationController@create'])->before('auth|admin');

Route::post('register',['as' =>'register_path', 'uses' => 'RegistrationController@store'])->before('auth|admin');

/*
|
| Password Reset and Reminders
|
*/

Route::controller('password', 'RemindersController');

/*
|
| Change User Password
|
*/
Route::group(['before' => 'auth'], function() {

  //Home Page
  Route::get('/', ['as' => 'home', 'uses' => 'HomeController@showHome']);

  // View all cobs between two dates
  Route::get('/cobs', ['as' => 'cobs', 'uses' => 'HomeController@showCobs']);

  // View multiple selected dates

 Route::get('/multicobs', ['as' => 'multicobs', 'uses' => 'HomeController@showMultiCobs']);


  Route::group(['before' => 'csrf'], function() {
      // Change password (POST)
      Route::post('/account/change-password', ['as' => 'change-password', 'uses' => 'PasswordController@update']);
  });

  // Change Password (GET)
  Route::get('/account/change-password', ['as' => 'change-password', 'uses' => 'PasswordController@index']);

  });


Route::get('/env',function() {
	dd(App::environment());
});

//calendar views
Route::get('/calendar',function(){
    $cob = Cob::all();
    $holidays = Holiday::all();
    $cob_dates = $cob->lists('cob_date');
    $holiday_dates = $holidays->lists('holiday_date');
    return View::make('calendar.index')
	      ->with(['cob_dates' => $cob_dates,
		      'holiday_dates' => $holiday_dates]);
})->before('auth');

//Data Tables example
Route::get('/datatables',function(){
  $batches_a = Batch::application()->where('batch_date', '=', '2014-04-24')->get();
  $batches_s = Batch::system()->where('batch_date', '=', '2014-04-24')->get();
  $batches_r = Batch::reporting()->where('batch_date', '=', '2014-04-24')->get();
  $batches_d = Batch::startofday()->where('batch_date', '=', '2014-04-24')->get();
  $batches_o = Batch::online()->where('batch_date', '=', '2014-04-24')->get();



  return View::make('datatables.index')
	  ->with(['batches_a' => $batches_a])
	  ->with(['batches_s' => $batches_s])
	  ->with(['batches_r' => $batches_r])
	  ->with(['batches_d' => $batches_d])
	  ->with(['batches_o' => $batches_o]);

});


//View All cobs summary by full time between two dates
Route::get('/cobs_time',function()
{
  return View::make('reports.cobstime');
})->before('auth');

//Dual list box for cob files
Route::get('dual',function(){
  $path = public_path() .'/cob_files';
  $files = File::files($path);
  return View::make('admin.files.index')
	    ->with(['files' => $files]);
})->before('auth|admin');

//Dual list box for reportts files
Route::get('dual_reports',function(){

  $files = File::files('./report_files');

  return View::make('admin.files.reports')
	    ->with(['files' => $files]);
})->before('auth|admin');

Route::get('/dashboard/{cob?}','StageController@showboard')->before('auth');

Route::get('pie/{cob?}', function($cob = null)
{

    if (is_null($cob)) {
      $cob = Cob::max('cob_date');
    }
   //$stages_avg = Stage::where('stg_batch_date','=','2014-04-24')->groupby('stage_name')->sum('stg_duration_sec');
   $cob_date = Carbon::createFromFormat('Y-m-d', $cob);
   //Carbon::setToStringFormat('Y-m-d');
   $cob_day_before = $cob_date->copy()->subDay();
   $cob_week_before = $cob_date->copy()->subWeek();
   $cob_month_before = $cob_date->copy()->subMonth();



   $stages_avg = DB::table('stages')
		 ->select('stage_name', DB::raw('avg(stg_duration_sec) as stg_duration_avg_sec'))
		 ->groupBy('stage_name')
		 ->get();
    $avg = array();

    foreach ($stages_avg as $stage) {
      # code...
     $avg = array_add($avg, $stage->stage_name, round($stage->stg_duration_avg_sec));

    }

    $cob_stages = Stage::where('stg_batch_date','=',$cob_date->toDateString())->get();
    $cob_day_before_stages = Stage::where('stg_batch_date','=',$cob_day_before->toDateString())->get();

    if($cob_day_before_stages->isEmpty()) {
      $cob_day_before = $cob_day_before->subDay();
      $cob_day_before_stages = Stage::where('stg_batch_date','=',$cob_day_before->toDateString())->get();
    }
    $cob_week_before_stages = Stage::where('stg_batch_date','=',$cob_week_before->toDateString())->get();
    $cob_week_before_cob = Cob::where('cob_date','=',$cob_week_before->toDateString())->get();
    if($cob_week_before_stages->isEmpty()) {
      $cob_week_before = $cob_week_before->subDay();
      $cob_week_before_stages = Stage::where('stg_batch_date','=',$cob_week_before->toDateString())->get();
    }
    $cob_month_before_stages = Stage::where('stg_batch_date','=',$cob_month_before->toDateString())->get();
    $cob_month_before_cob = Cob::where('cob_date','=',$cob_month_before->toDateString())->get();
    if($cob_month_before_stages->isEmpty()) {
      $cob_month_before = $cob_month_before->subDay();
      $cob_month_before_stages = Stage::where('stg_batch_date','=',$cob_month_before->toDateString())->get();
    }
    $batches = Batch::where('batch_date', '=', $cob_date->toDateString())->get();
    $reports = Report::where('batch_date','=', $cob_date->toDateString())->get();

   $cob_dates = array($cob_date->toDateString(),$cob_day_before->toDateString(),$cob_week_before->toDateString(),$cob_month_before->toDateString());
   $cob_times = Cob::whereIn('cob_date', $cob_dates)->orderBy('cob_date','DESC')->lists('cob_duration_min');

   return View::make('reports.pie')
	    ->with(['stages_avg' => $avg])
	    ->with(['cob_stages' => $cob_stages])
	    ->with(['batch_date' => $cob_date->toDateString()])
	    ->with(['batches' => $batches , 'reports' => $reports])
	    ->with(['stages_name' => $cob_stages->lists('stage_name'),
		    'cob_today' => $cob_stages->lists('stg_duration_min'),
		    'cob_day_before' => $cob_day_before_stages->lists('stg_duration_min'),
		    'cob_week_before' => $cob_week_before_stages->lists('stg_duration_min'),
		    'cob_month_before' => $cob_month_before_stages->lists('stg_duration_min'),
		    'cob_today_date' => $cob_date->toDateString(),
		    'cob_day_before_date' => $cob_day_before->toDateString(),
		    'cob_week_before_date' => $cob_week_before->toDateString(),
		    'cob_month_before_date' => $cob_month_before->toDateString(),
		    'cob_dates' => $cob_dates,
		    'cob_times' => $cob_times]);
})->before('auth');

//Added new routes for session management
Route::get('login','SessionsController@create');
Route::get('logout','SessionsController@destroy');

// Get chart of all cobs between two dates
Route::post('cob_reports_all','StageController@allCobs');

// Get chart of all multi cobs dates
Route::post('multicob_reports_all','StageController@allMultiCobs');


// Get chart of all cob times between two dates
Route::post('cob_reports_all_time','CobController@cobtimes');


//Get chart for comparing two cob dates
Route::post('cob_reports','StageController@daily');

//Get files to processes by Queues
Route::post('load_files',function()
{
    $input = Input::get('list_files');

    foreach ($input as $key => $value) {
      # code...
    Queue::push('FileService',$value);

    }

    return 'ok';



});

Route::post('load_reports',function()
{
    $input = Input::get('report_files');

    foreach ($input as $key => $value) {
      # code...
    Queue::push('ReportService',$value);

    }

    return 'ok';



});

Route::resource('sessions', 'SessionsController',['only' => ['create','destroy','store']]);

Route::get('top',function(){
  $batches =  Batch::where('batch_date','=','2014-04-24')
	 ->orderBy('job_duration_sec','desc')
	 ->take(5)->get();

   return View::make('reports.top')
	   ->with(['batches' => $batches]);
});

Route::get('list_files',function()
   {
   $files = File::files('./public/cob_files');
   //dd($files);
   //$files = File::allFiles('./public/cob_files');
   echo "<ul>";
   foreach ($files as $file) {
      # code...
      //dd($file);
      echo "<li>$file</li>";
   }
   echo "</ul>";
   /*
   $files = File::allFiles('./public/cob_files');
   foreach ($files as $file)
   {
    echo (string)$file, "\n";
   }
   */
   });

// Route::get('admin/reports/daily', 'ReportsController@daily')->before('admin');
Route::get('admin/reports/daily', 'ReportsController@daily');
Route::get('admin/reports/daily/A', 'StageController@daily');

// Generate Summary from batches and insert it into stages

// Create Batch Summary
Route::get('/create_summary','BatchController@create_summary');

// Generate summary rows from stages table and insert it into cobs table
Route::get('/create_summary_cob', 'CobController@create_summary');



Route::get('/file1', function()
{

	$contents = File::get('./public/cob_files/20140425_JOB.TIMES.tsv');
	if ($contents)
	{
		$lines = explode(PHP_EOL, $contents);
		$count = 0;
		foreach ($lines as $line) {
			if ($count > 0 ) {
			$vals = preg_split('/\s+/', $line);
			//Iterate through file
			/*
				    $first = reset($vals);
				$last = end($vals);

					dd($first, $last);
			*/
			$result = count($vals);
			if ($result > 8) {
			$batch = new Batch;
			$batch->company = $vals[0];
			$batch->batch_id = $vals[1];
			$batch->job_name = $vals[2];
			$batch->batch_date = $vals[3];
			$batch->start_time = $vals[4];
			$batch->end_time = $vals[5];
			$batch->job_duration = $vals[6];
			$batch->batch_stage = $vals[7];
			$batch->records_processed = $vals[8];
			$batch->throughput = $vals[9];
			$batch->no_of_agents = $vals[10];
			$batch->save();
			}
			else
			{
				die($count);
			}
				}
			$count++;
			}
			echo "number of lines loaded is ".$count;
		//dd($lines);
	}

	//File::put('test2.txt', 'file contents');
});
