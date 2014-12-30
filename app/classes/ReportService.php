<?php

class ReportService {

	public $delete = true;

    public function fire($job, $data)
    {

		Log::info("Report loaded is $data");
		$file_name = explode("/", $data);
		$file_date = explode(".",$file_name[3]);
		$batch_date = $file_date[1];

		$contents = File::get($data);
	if ($contents)
	{
		$lines = explode(PHP_EOL, $contents);
		$count = 0;
		foreach ($lines as $line) {
			if ($count > 0 ) {
			$vals = explode(",", $line);
			//Iterate through file
			/*
				    $first = reset($vals);
				$last = end($vals);

					dd($first, $last);
			*/
			$result = count($vals);
			if ($result == 7) {

	$report = new Report;
			$report->batch_name = $vals[0];
			$report->company = $vals[1];
			$report->report_type = $vals[2];
			$report->report_name = $vals[3];
			$report->start_time = $vals[4];
			$report->end_time = $vals[5];
			$report->elapsed_time = $vals[6];
		$report->elapsed_time_sec = time_to_sec($vals[6]);
		$report->batch_date = $batch_date;
			$report->save();
			}
	else {
	  Log::info("line escaped at $count in report file $data array size is $result");
	  Log::info("$line");
	  //continue;
	}
				}
			$count++;
			}
      Log::info("number of lines loaded for report $data is $count");
		//dd($lines);
	}
	}



}