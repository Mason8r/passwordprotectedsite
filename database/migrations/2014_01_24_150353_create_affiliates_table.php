<?php

use Illuminate\Database\Migrations\Migration;

class CreateAffiliatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliates', function($t) {
			$t->increments('id'); //
			$t->string('name'); //The name of the affiliate
			$t->string('url'); //the URL in which people will be going too
			$t->boolean('status'); //on or off
			$t->string('form_data');
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
		Schema::drop('affiliates');
	}

}