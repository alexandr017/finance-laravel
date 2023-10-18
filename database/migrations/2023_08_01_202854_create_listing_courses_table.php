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
        Schema::create('listing_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            $table->string('listing_id');
            $table->integer('sort');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('listing_id')->references('id')->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_courses');
    }
};
