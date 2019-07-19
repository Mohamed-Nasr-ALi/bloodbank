<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 35);
			$table->string('email', 20)->unique();
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->integer('pin_code')->unique()->nullable();
			$table->string('phone')->unique();
			$table->date('b_o_d');
			$table->string('password');
			$table->date('order_last_date');
			$table->boolean('is_active')->default(1);
			$table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}