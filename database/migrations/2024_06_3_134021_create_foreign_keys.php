<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('Class_id')->references('id')->on('classrooms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});


        Schema::table('my__parents', function(Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
        });


        Schema::table('parent_attachments', function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('my__parents')->onDelete('cascade');
        });



	}

	public function down()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->dropForeign('classrooms_Grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_Grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_Class_id_foreign');
		});
	}
}
