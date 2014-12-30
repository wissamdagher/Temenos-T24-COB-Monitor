<?php

class StageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
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
	public function destroy($id)
	{
		//
	}
	//Custom function to prepare charts
	public function daily($app_code = 'A')
    {
	// You'll probably want to limit this to the current month
	// or something.
	   $cob1 = Input::get('cob_date1');
	   $cob2 = Input::get('cob_date2');

	   $cob_date_1 = Carbon::createFromFormat('Y-m-d', $cob1);
	   $cob_date_2 = Carbon::createFromFormat('Y-m-d', $cob2);

       // $cob_dates = array($cob_date_1,$cob_date_2);

      //  dd($cob_dates);

	$yesterday = Stage::where('stg_batch_date', '=', $cob_date_1->toDateString())->get();
       // dd($yesterday->isEmpty());
	$daily = Stage::where('stg_batch_date', '=', $cob_date_2->toDateString())->get();
	//dd($daily);

     while($yesterday->isEmpty()) {
      $cob_date_1 = $cob_date_1->subDay();
      $yesterday = Stage::where('stg_batch_date', '=', $cob_date_1->toDateString())->get();
    }

     while($daily->isEmpty()) {
      $cob_date_2 = $cob_date_2->subDay();
      $daily = Stage::where('stg_batch_date', '=', $cob_date_2->toDateString())->get();
    }

      $cob_dates = array($cob_date_1->toDateString(),$cob_date_2->toDateString());
      //Get all cobs for these dates
      $cobstartsummaries = Cob::whereIn('cob_date',$cob_dates)->get();

	return View::make('admin.reports.daily')
	    ->with([
		'dates' => $daily->lists('stage_name'),
		'totals' => $yesterday->lists('stg_duration_min'),
		'totals2' => $daily->lists('stg_duration_min'),
		'cob_dates' => $cob_dates,
		'cobstartsummaries' => $cobstartsummaries
	    ]);
    }

    public function allCobs() {
	$start_date = Input::get('cob_date1');
	$end_date = Input::get('cob_date2');

		$cobs = DB::Select(DB::raw('select distinct stg_batch_date from stages where stg_batch_date between :start and :end'),
			array('start'=> $start_date,'end'=>$end_date));

		$all_cobs = array();
    $cob_dates = array();

		foreach ($cobs as $cob) {
			# code...
			$stg = Stage::where('stg_batch_date','=',$cob->stg_batch_date)->get();
			$all_cobs[$cob->stg_batch_date] = $stg->lists('stg_duration_min');
      array_push($cob_dates,$cob->stg_batch_date);
		}

		   $stages_avg = DB::table('stages')
		 ->select('stage_name', DB::raw('avg(stg_duration_sec) as stg_duration_avg_sec'))
		 ->groupBy('stage_name')
		 ->get();
		$avg = array();

		foreach ($stages_avg as $stage) {
		# code...
		$avg = array_add($avg, $stage->stage_name, round(($stage->stg_duration_avg_sec / 60)));

		}

		$stages_name = array('APPLICATION','SYSTEM WIDE','REPORTING','START OF DAY','ONLINE');

    //get Cob Start summary for selected dates
    $cobstartsummaries = Cob::whereIn('cob_date',$cob_dates)->get();
		return View::make('admin.reports.allcobs')
				->with(['dates' => $stages_name])
				->with(['allcobs' => $all_cobs])
				->with(['stages_avg' => $avg])
	->with(['cobstartsummaries' => $cobstartsummaries]);
    }

    public function showboard ($cob = null) {
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

    while($cob_day_before_stages->isEmpty()) {
      $cob_day_before = $cob_day_before->subDay();
      $cob_day_before_stages = Stage::where('stg_batch_date','=',$cob_day_before->toDateString())->get();
    }
    $cob_week_before_stages = Stage::where('stg_batch_date','=',$cob_week_before->toDateString())->get();
    $cob_week_before_cob = Cob::where('cob_date','=',$cob_week_before->toDateString())->get();
    while($cob_week_before_stages->isEmpty()) {
      $cob_week_before = $cob_week_before->subDay();
      $cob_week_before_stages = Stage::where('stg_batch_date','=',$cob_week_before->toDateString())->get();
      $cob_week_before_cob = Cob::where('cob_date','=',$cob_week_before->toDateString())->get();
    }

    $cob_month_before_stages = Stage::where('stg_batch_date','=',$cob_month_before->toDateString())->get();
    $cob_month_before_cob = Cob::where('cob_date','=',$cob_month_before->toDateString())->get();
    while($cob_month_before_stages->isEmpty()) {
      $cob_month_before = $cob_month_before->subDay();
      $cob_month_before_stages = Stage::where('stg_batch_date','=',$cob_month_before->toDateString())->get();
    }
    $batches = Batch::where('batch_date', '=', $cob_date->toDateString())->get();
    $reports = Report::where('batch_date','=', $cob_date->toDateString())->get();

   $cob_dates = array($cob_date->toDateString(),$cob_day_before->toDateString(),$cob_week_before->toDateString(),$cob_month_before->toDateString());
   $cob_times = Cob::whereIn('cob_date', $cob_dates)->orderBy('cob_date','DESC')->lists('cob_duration_min');

    //get Cob Start summary for selected dates
    $cobstartsummaries = Cob::whereIn('cob_date',$cob_dates)->get();

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
		    'cob_times' => $cob_times,
		    'cobstartsummaries' => $cobstartsummaries]);

    }

// Show all multicobs
    public function allMultiCobs() {
      $start_date = Input::get('cob_date1');

      $multiDates = explode(',', $start_date);

    $cobs = DB::table('cobs')->whereIn('cob_date',$multiDates)->select('cob_date')->distinct()->get();

    //dd($cobs);

    $all_cobs = array();
    $cob_dates = array();

    foreach ($cobs as $cob) {
      # code...
      $stg = Stage::where('stg_batch_date','=',$cob->cob_date)->get();
      $all_cobs[$cob->cob_date] = $stg->lists('stg_duration_min');
      array_push($cob_dates,$cob->cob_date);
    }

       $stages_avg = DB::table('stages')
		 ->select('stage_name', DB::raw('avg(stg_duration_sec) as stg_duration_avg_sec'))
		 ->groupBy('stage_name')
		 ->get();
	$avg = array();

	foreach ($stages_avg as $stage) {
	  # code...
	$avg = array_add($avg, $stage->stage_name, round(($stage->stg_duration_avg_sec / 60)));

	}

    $stages_name = array('APPLICATION','SYSTEM WIDE','REPORTING','START OF DAY','ONLINE');

    //get Cob Start summary for selected dates
    $cobstartsummaries = Cob::whereIn('cob_date',$cob_dates)->get();
    return View::make('admin.reports.allcobs')
	->with(['dates' => $stages_name])
	->with(['allcobs' => $all_cobs])
	->with(['stages_avg' => $avg])
	->with(['cobstartsummaries' => $cobstartsummaries]);
    }

}