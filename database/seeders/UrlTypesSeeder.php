<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UrlTypesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('url_section_types')->insert([
            ['type' => 'Страницы'], // 1
            ['type' => 'Категории записей'], // 2
            ['type' => 'Записи'], // 3
            ['type' => 'Сотрудник'], // 4
            ['type' => 'Компания'], // 5
            ['type' => 'Листинг'], // 6
        ]);
    }
}
