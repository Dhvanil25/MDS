<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submits', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->integer('semester_id');
            $table->integer('subject_id');
            $table->integer('faculty_id');
            $table->integer('student_id');
            $table->integer('assignment_id');
            $table->integer('faculty_subject_id');
            $table->date('supload_date');
            $table->string('pdf');
            $table->boolean('status')->default(0);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('assignment_submits');
    }
}
