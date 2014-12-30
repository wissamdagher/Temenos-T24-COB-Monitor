<?php

class CobController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /cob
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /cob/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /cob
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /cob/{id}
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
	 * GET /cob/{id}/edit
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
	 * PUT /cob/{id}
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
	 * DELETE /cob/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function cobtimes() {
	$start_date = Input::get('cob_date1');
	$end_date = Input::get('cob_date2');


		//$cobs = DB::Select(DB::raw('select distinct stg_batch_date from stages where stg_batch_date between :start and :end'),
		//	array('start'=> $start_date,'end'=>$end_date));

		$cobs = Stage::whereBetween('stg_batch_date',array($start_date,$end_date))->distinct()->lists('stg_batch_date');
		//$cob_dates = array($cob_day_before->toDateString(),$cob_week_before->toDateString(),$cob_month_before->toDateString());
		$cob_labels = $cobs;
		$cob_times = Cob::whereIn('cob_date', $cobs)->orderBy('cob_date','DESC')->lists('cob_duration_min');


		$all_cobs = array();
		foreach ($cobs as $cob) {
			# code...
			$stg = Stage::where('stg_batch_date','=',$cob)->get();
			$all_cobs[$cob] = $stg->lists('stg_duration_min');
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
		return View::make('admin.reports.allcobstime')
				->with(['dates' => $stages_name,
						 'allcobs' => $all_cobs,
						 'stages_avg' => $avg,
						 'cob_dates' => $cob_labels,
						 'cob_times' => $cob_times ]);
    }

    public function create_summary (){
	    $results = DB::select(DB::raw('select sec_to_time(SUM(stg_duration_sec)) as cob_duration,SUM(stg_duration_sec) as cob_duration_sec,stg_batch_date as cob_date,Min(stg_start_time) as cob_start_time,MAX(stg_end_time) as cob_end_time from stages group by stg_batch_date
'));
	 foreach ($results as $result) {
	    //Instintiate a new model
	    $cob = new Cob;
	    $cob->cob_date = $result->cob_date;
	    $cob->cob_duration = $result->cob_duration;
	    $cob->cob_duration_sec = $result->cob_duration_sec;
	    $cob->cob_duration_min = (int) ($result->cob_duration_sec / 60);
	    $cob->cob_start_time = $result->cob_start_time;
	    $cob->cob_end_time = $result->cob_end_time;
	    $cob->save();



	 }

   return 'OK';
    }

}