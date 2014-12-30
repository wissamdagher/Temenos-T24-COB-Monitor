<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCobDurationMinToCobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cobs', function(Blueprint $table)
		{
			$table->integer('cob_duration_min');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cobs', function(Blueprint $table)
		{
			$table->dropColumn('cob_duration_min');
		});
	}

}
