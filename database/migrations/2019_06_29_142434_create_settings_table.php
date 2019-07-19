<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 15)->unique()->default('null');
			$table->string('email')->unique()->default('null');
			$table->text('about_app');
			$table->string('fb_link')->default('null');
			$table->string('tw_link')->default('null');
			$table->string('tub_link')->default('null');
			$table->string('insta_link')->default('null');
			$table->string('whatsapp_link')->default('null');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}