<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('listing_courses', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->change();
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->change();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listing_courses', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->string('course_id')->change();
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->string('course_id')->change();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('id')->change();
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }
};
