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
        Schema::create('school_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('title');
            $table->tinyInteger('status');
            $table->string('character_code')->nullable();
            $table->integer('sort');
            $table->text('pluses')->nullable();
            $table->text('minuses')->nullable();
            $table->text('content')->nullable();
            $table->float('rating');
            $table->string('author_name');
            $table->integer('code')->nullable();
            $table->integer('old_id');
            $table->timestamps();

            $table->foreign('school_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_reviews');
    }
};
