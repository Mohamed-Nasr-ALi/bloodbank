<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name', 35);
			$table->integer('patient_age');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('quantity');
			$table->string('hospital_name', 30);
			$table->integer('city_id')->unsigned();
			$table->string('hospital_address', 30);
			$table->string('phone', 15);
			$table->text('notes');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}