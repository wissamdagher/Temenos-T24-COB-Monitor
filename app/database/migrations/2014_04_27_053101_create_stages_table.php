<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('stage_name');
			$table->date('stg_batch_date');
			$table->time('stg_start_time');
			$table->time('stg_end_time');
			$table->string('stg_duration');
			$table->integer('stg_duration_sec');
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
		Schema::drop('stages');
	}

}
