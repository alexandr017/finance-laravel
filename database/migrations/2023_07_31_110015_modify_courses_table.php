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
            $table->string('id')->change();
            $table->unsignedBigInteger('company_id')->nullable()->change();
            $table->bigInteger('external_id')->after('company_id')->nullable();
            $table->integer('duration')->after('status');
            $table->integer('duration_in_hours')->after('duration');
            $table->string('duration_type')->after('duration');
            $table->integer('cost')->after('duration_type')->nullable();
            $table->integer('sale_cost')->after('cost')->nullable();
            $table->integer('sale_value')->after('sale_cost')->nullable();
            $table->integer('installment_period')->after('sale_value')->nullable();
            $table->integer('installment_payment')->after('installment_period')->nullable();
            $table->integer('payment_value')->after('sale_value')->nullable();
            $table->string('currency')->default('RUB')->after('payment_value');
            $table->string('payment_type')->after('currency')->nullable();
            $table->tinyInteger('is_cost_by_query')->after('payment_type')->nullable();
            $table->tinyInteger('reviews_count')->after('is_cost_by_query')->nullable();
            $table->text('statistics_link')->change();
            $table->text('affiliate_link')->change();

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement()->change();
            $table->unsignedInteger('company_id')->change();
            $table->dropColumn([
                'external_id',
                'duration',
                'duration_type',
                'cost',
                'sale_cost',
                'sale_value',
                'payment_value',
                'currency',
                'payment_type',
                'is_cost_by_query',
                'duration_in_hours',
                'reviews_count',
                'installment_period',
                'installment_payment'
                ]);
            $table->string('statistics_link')->change();
            $table->string('affiliate_link')->change();
            $table->dropForeign(['company_id']);
        });
    }
};
