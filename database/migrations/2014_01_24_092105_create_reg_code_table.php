<?php

use Illuminate\Database\Migrations\Migration;

class CreateRegCodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_codes', function($t) {
			$t->increments('id');
			$t->string('reg_code')->unique();
			$t->string('title');
			$t->string('first_name');
			$t->string('last_name');
			$t->string('company');
			$t->string('mailing_code');
			$t->string('letter_code');
			$t->string('street1');
			$t->string('street2');
			$t->string('street3');
			$t->string('city');
			$t->string('county');
			$t->string('postcode');
			$t->string('country');
			$t->string('email');
			$t->string('source');
			$t->string('system');
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
		Schema::drop('reg_codes');
	}

}