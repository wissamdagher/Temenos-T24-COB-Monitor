<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmcdevsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emcdevs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('dev_name');
			$table->string('configuration');
			$table->string('emulation');
			$table->integer('allocated_perc');
			$table->integer('capacity');
			$table->string('subscription');
			$table->float('written_gb');
			$table->string('shared_tracks');
			$table->string('persistent_alloc');
			$table->string('status');
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
		Schema::drop('emcdevs');
	}

}
