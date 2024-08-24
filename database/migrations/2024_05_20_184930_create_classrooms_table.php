<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table) {
			// $table->id();
			// $table->json('Name_Class');
			// $table->json('Grade_id');
			// $table->timestamps();
			$table->id();
			$table->string('Name_Class');
			$table->biginteger('Grade_id')->unsigned();;
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('classrooms');
	}
}
