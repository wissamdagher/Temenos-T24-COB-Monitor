<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStartCobTimeToCobTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Cobs', function(Blueprint $table)
		{
			$table->string('cob_start_time');
			$table->string('cob_end_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Cobs', function(Blueprint $table)
		{
			$table->dropColumn('cob_start_time');
			$table->dropColumn('cob_end_time');
		});
	}

}
