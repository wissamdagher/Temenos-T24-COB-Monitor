<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('batch_name');
			$table->string('company');
			$table->string('report_type');
			$table->string('report_name');
			$table->time('start_time');
			$table->time('end_time');
			$table->string('elapsed_time');
			$table->integer('elapsed_time_sec');
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
		Schema::drop('reports');
	}

}
