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
            $table->dropForeign(['listing_id']);
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('listing_id')->change();
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->change();
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->foreign('listing_id')->references('id')->on('listings');
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('listings');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listing_courses', function (Blueprint $table) {
            $table->dropForeign(['listing_id']);
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->string('listing_id')->change();
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->string('parent_id')->change();
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->string('id')->change();
        });

        Schema::table('listing_courses', function (Blueprint $table) {
            $table->foreign('listing_id')->references('id')->on('listings');
        });

        Schema::table('listings', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('listings');
        });
    }
};
