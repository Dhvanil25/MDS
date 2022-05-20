<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->integer('semester_id');
            $table->integer('subject_id');
            $table->integer('faculty_id');
            $table->integer('faculty_subject_id');
            $table->string('assignment_title');
            $table->string('assignment_question');
            $table->date('upload_date');
            $table->date('submit_date');
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
        Schema::dropIfExists('assignments');
    }
}
