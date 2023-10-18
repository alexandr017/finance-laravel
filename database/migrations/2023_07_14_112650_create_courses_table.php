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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('company_id'); // key
            $table->string('statistics_link'); // кейтаро
            $table->string('affiliate_link'); // партнерка
            $table->string('direct_link'); // прямая
            // todo
            //duration	duration_type	old_cost	sale_cost	sale_value (%)	payment_value	payment_type	is_cost_by_query
            $table->unsignedTinyInteger('status');
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
        Schema::dropIfExists('courses');
    }
};
