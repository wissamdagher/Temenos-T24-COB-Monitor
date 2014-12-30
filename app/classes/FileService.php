<?php

class FileService {

	public $delete = true;

    public function fire($job, $data)
    {

			Log::info("File loaded is $data");
		$contents = File::get($data);
	if ($contents)
	{
		$lines = explode(PHP_EOL, $contents);
		$count = 0;
    $cob_date = '';
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
			if ($result == 11) {
	  //set cob_date
	$cob_date  = $vals[3];
	$batch = new Batch;
			$batch->company = $vals[0];
			$batch->batch_id = $vals[1];
			$batch->job_name = $vals[2];
			$batch->batch_date = $vals[3];
			$batch->start_time = $vals[4];
			$batch->end_time = $vals[5];
			$batch->job_duration = $vals[6];
	$batch->job_duration_sec = time_to_sec($vals[6]);
			$batch->batch_stage = $vals[7];
			$batch->records_processed = $vals[8];
			$batch->throughput = $vals[9];
			$batch->no_of_agents = $vals[10];
			$batch->save();
			}
	else {
	  Log::info("line escaped at $count in file $data array size is $result");
	  Log::info("$line");
	  //continue;
	}
				}
			$count++;
			}
      Log::info("number of lines loaded for $data is $count");
		  $event = Event::fire('cob.loaded', array($cob_date));
	}
	}



}