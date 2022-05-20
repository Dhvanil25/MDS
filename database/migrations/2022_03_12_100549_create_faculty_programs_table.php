<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->integer('semester_id');
            $table->integer('subject_id');
            $table->integer('faculty_id');
            $table->integer('faculty_subject_id');
            $table->string('program_title');
            $table->string('program_description')->nullable();
            $table->string('program')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_programs');
    }
}
