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
        $typeToNewAlias = [
            'Отзывы' => 'otzyvy',
            'Реквизиты' => 'rekvizity'
        ];

        foreach ($typeToNewAlias as $type => $alias) {
            DB::table('companies_children_page_types')
                ->where('type', $type)
                ->update(['alias' => $alias]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $typeToOldAlias = [
            'Отзывы' => 'reviews',
            'Реквизиты' => 'requisites'
        ];

        foreach ($typeToOldAlias as $type => $alias) {
            DB::table('companies_children_page_types')
                ->where('type', $type)
                ->update(['alias' => $alias]);
        }
    }
};
