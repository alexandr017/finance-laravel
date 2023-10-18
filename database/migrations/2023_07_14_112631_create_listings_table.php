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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_description');
            $table->string('h1');
            $table->string('breadcrumbs');
            $table->text('lead');
            $table->text('content');
            $table->unsignedInteger('author_id'); // key
            $table->unsignedTinyInteger('status');
            $table->decimal('rating_value', 3, 2);
            $table->unsignedInteger('rating_count');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('old_id')->nullable();
            // Вложенность todo parent_id ?
            // todo best_courses
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
