<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPooltypeToEmcdevsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('emcdevs', function(Blueprint $table) {
			$table->string('pooltype');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('emcdevs', function(Blueprint $table) {
			$table->dropColumn('pooltype');
		});
	}

}
