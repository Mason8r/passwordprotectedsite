<?php

use Illuminate\Database\Migrations\Migration;

class CreateTrackingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tracking', function($t) {
			$t->increments('id');
			$t->integer('reg_codes_id');
			$t->string('source');
			$t->string('type');
			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tracking');
	}

}