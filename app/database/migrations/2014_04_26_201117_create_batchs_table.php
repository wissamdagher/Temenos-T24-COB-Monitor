<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBatchsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('batchs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('company');
			$table->string('batch_id');
			$table->string('job_name');
			$table->date('batch_date');
			$table->time('start_time');
			$table->time('end_time');
			$table->string('job_duration');
			$table->integer('job_duration_sec');
			$table->string('batch_stage');
			$table->integer('records_processed');
			$table->integer('throughput');
			$table->integer('no_of_agents');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('batchs');
	}

}
