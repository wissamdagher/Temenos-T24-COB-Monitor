<?php

class BatchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /batch
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /batch/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /batch
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /batch/{id}
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
	 * GET /batch/{id}/edit
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
	 * PUT /batch/{id}
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
	 * DELETE /batch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function create_summary() {

		//List of Stages
		$stages = array('A' => 'APPLICATION','S' => 'SYSTEM WIDE','R' => 'REPORTING','D' => 'START OF DAY','O' =>'ONLINE');
		// Get distinct batch_dates
		$batch_dates = DB::select(
			DB::raw('select distinct batch_date from batches order by batch_date asc'));

		foreach ($batch_dates as $batch_date) {
			   foreach ($stages as $stage => $val) {
				$stage_code = $stage;
				$stage = $stage."%";

	$results = DB::select(
		DB::raw('select  @start_time:=(select start_time from batches where
						    batch_date = :v_batch_date1
							and start_time > "13:00:00"
							and batch_stage like :v_stage1
						order by id asc
						limit 1) as start_time,
					    @end_time_temp:=(select
						    end_time
						from
						    batches
						where
						    batch_date = :v_batch_date2
						    and batch_stage like :v_stage2
						order by id desc
						limit 1) as end_time_original,
					    @end_time:=IF(@end_time_temp < "13:00:00",
						ADDTIME(@end_time_temp, "24:00:00"),
						@end_time_temp) as end_time,
					    @stage_duration:=timediff(@end_time, @start_time) as stage_duration,
					    time_to_sec(@stage_duration) as stage_duration_sec '),
		array('v_batch_date1' => $batch_date->batch_date, 'v_stage1' => $stage,
			'v_batch_date2' => $batch_date->batch_date, 'v_stage2' => $stage));

	 foreach ($results as $result) {
	    if (is_null($result->start_time) || is_null($result->end_time))
	    {
		$error_message = 'Stage '.$val.' for '.$batch_date->batch_date.' Could not be created';
		Log::warning($error_message);
		continue;
	    }
	    //Instintiate a new model
	    $stg = new Stage;
	    $stg->stage_name = $val;
	    $stg->stg_batch_date = $batch_date->batch_date;
	    $stg->stg_start_time = $result->start_time;
	    $stg->stg_end_time = $result->end_time;
	    $stg->stg_duration = $result->stage_duration;
	    $stg->stg_duration_sec = $result->stage_duration_sec;
	    $stg->stg_duration_min = (int) ($result->stage_duration_sec / 60);
	    $stg->stg_code = $stage_code;
	    $stg->save();

	 }
   }
		}
   return 'OK';
}


}