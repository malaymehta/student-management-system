<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablesForAddingForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
        });

        Schema::table('batch_images', function (Blueprint $table) {
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
        });

        Schema::table('student_images', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });

        Schema::table('year_wise_courses', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_department_id_foreign');
            $table->dropForeign('users_designation_id_foreign');
        });

        Schema::table('batch_images', function (Blueprint $table) {
            $table->dropForeign('batch_images_batch_id_foreign');
        });

        Schema::table('batches', function (Blueprint $table) {
            $table->dropForeign('batches_academic_year_id_foreign');
            $table->dropForeign('batches_course_id_foreign');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('sections_academic_year_id_foreign');
            $table->dropForeign('sections_batch_id_foreign');
        });

        Schema::table('student_images', function (Blueprint $table) {
            $table->dropForeign('student_images_student_id_foreign');
            $table->dropForeign('student_images_image_id_foreign');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_academic_year_id_foreign');
            $table->dropForeign('students_course_id_foreign');
            $table->dropForeign('students_batch_id_foreign');
            $table->dropForeign('students_section_id_foreign');
        });

        Schema::table('year_wise_courses', function (Blueprint $table) {
            $table->dropForeign('year_wise_courses_academic_year_id_foreign');
            $table->dropForeign('year_wise_courses_course_id_foreign');
        });
    }
}
