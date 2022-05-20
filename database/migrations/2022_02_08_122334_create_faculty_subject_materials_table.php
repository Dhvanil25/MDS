<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultySubjectMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_subject_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->integer('semester_id');
            $table->integer('subject_id');
            $table->integer('faculty_id');
            $table->integer('faculty_subject_id');
            $table->string('material_title');
            $table->string('material_description')->nullable();
            $table->string('material_video_url')->nullable();
            $table->string('material_pdf')->nullable();
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
        Schema::dropIfExists('faculty_subject_materials');
    }
}
