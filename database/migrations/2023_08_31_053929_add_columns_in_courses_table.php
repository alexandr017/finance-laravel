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
        Schema::table('courses', function (Blueprint $table) {
            $table->boolean('is_popular')->after('status');
            $table->boolean('is_best')->after('is_popular');
            $table->boolean('has_promotion')->after('is_best');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('is_popular');
            $table->dropColumn('is_best');
            $table->dropColumn('has_promotion');
        });
    }
};
