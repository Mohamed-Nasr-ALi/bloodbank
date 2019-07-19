<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 20);
			$table->integer('order_id')->unsigned();
			$table->string('content');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}