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
        Schema::create('seo_for_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_description');
            $table->string('h1');
            $table->string('breadcrumbs')->nullable();
            $table->text('lead')->nullable();
            $table->text('content')->nullable();
            $table->decimal('rating_value', 3, 2)->nullable();
            $table->unsignedInteger('rating_count')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_for_pages');
    }
};
