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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('comment_type'); // 0 = post comment 1 = company reviews
            $table->string('name'); // comment and review
            $table->string('email'); // comment and review
            $table->string('pluses')->nullable();; // reviews
            $table->string('minuses')->nullable();; // reviews
            $table->text('comment'); // comment and review
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('post_id')->nullable(); // comment
            $table->unsignedInteger('company_id')->nullable(); // review
            $table->unsignedTinyInteger('rating')->nullable(); // review (form 1 to 5)
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('old_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
