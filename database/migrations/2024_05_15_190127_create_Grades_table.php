<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('Grades', function(Blueprint $table) {
			// $table->id();
			// $table->json('Name');
			// $table->json('Notes');
            // $table->timestamps();
			$table->id();
			$table->string('Name');
			$table->text('Notes')->nullable();;
            $table->timestamps();

		});
	}

	public function down()
	{
		Schema::dropIfExists('Grades');
	}
}
