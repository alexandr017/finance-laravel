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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->string('title');
            $table->string('meta_description');
            $table->string('h1');
            $table->string('breadcrumbs');
            $table->text('lead');
            $table->text('content');
            $table->decimal('rating_value', 3, 2);
            $table->unsignedInteger('rating_count');
            $table->string('job')->nullable();
            $table->string('email')->nullable();
            $table->string('vk_link')->nullable();
            $table->string('telegram_link')->nullable();
            $table->text('education')->nullable();
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('sort_order')->default(500);
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
        Schema::dropIfExists('employees');
    }
};
