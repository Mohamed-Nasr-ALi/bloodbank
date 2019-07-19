<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 20);
			$table->string('email');
			$table->string('phone', 15);
			$table->string('subject');
			$table->text('message');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}