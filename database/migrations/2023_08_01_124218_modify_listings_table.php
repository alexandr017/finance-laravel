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
        Schema::table('listings', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('listings');

            $table->string('id')->change();
            $table->string('name')->after('id');
            $table->text('description')->after('title');
            $table->text('slug')->after('description');
            $table->float('rating_sum')->after('rating_count');
            $table->string('meta_title')->after('meta_description');
            $table->string('parent_id')->after('id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable()->change();

            $table->foreign('author_id')->references('id')->on('employees');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['parent_id']);

            $table->unsignedBigInteger('id')->autoIncrement()->change();
            $table->unsignedInteger('author_id')->change();

            $table->dropColumn([
                'name',
                'description',
                'slug',
                'rating_sum',
                'meta_title',
                'parent_id',
            ]);
        });
    }
};
