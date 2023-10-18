<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PageSeeder extends Seeder
{
    private const SECTION_PAGE_TYPE_ID = 1;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'title' => 'Политика конфиденциальности сервиса Курсы.ру',
                'meta_description'  => 'Ваша конфиденциальность важна для нас. Данный документ регламентирует обработку персональных данных пользователей. Узнайте как используются ваши данные.',
                'h1'  => 'Политика обработки персональных данных',
                'breadcrumbs' => 'Политика конфидециальности',
                'content' =>  file_get_contents(base_path() . '/database/seeders/content/privacy.html'),
                'status' => 1
            ],
            [
                'title' => 'Пользовательское соглашение интернет-сервиса Курсы.ру',
                'meta_description'  => 'Настоящее соглашение регулирует отношения пользователей и администрации интернет-сервиса. Договор описывает права, обязанности и прочие нюансы сотрудничества.',
                'h1'  => 'Пользовательское соглашение',
                'breadcrumbs' => 'Соглашение',
                'content' => file_get_contents(base_path() . '/database/seeders/content/rules.html'),
                'status' => 1
            ],
            [
                'title' => 'Положение об отказе от ответственности и гарантий сервиса Курсы.ру',
                'meta_description'  => 'Настоящее Положение регламентирует объем ответственности и гарантий, предусмотренных Администрацией сайта, при использования Пользователями его возможностей.',
                'h1'  => 'Положение об отказе от ответственности и гарантий',
                'breadcrumbs' => 'Отказ от ответственности',
                'content' => file_get_contents(base_path() . '/database/seeders/content/disclaimer.html'),
                'status' => 1
            ],
        ]);
        DB::table('urls')->insert([
            [
                'url' => 'privacy',
                'section_type' => PageSeeder::SECTION_PAGE_TYPE_ID,
                'section_id' => 1
            ],
            [
                'url' => 'rules',
                'section_type' => PageSeeder::SECTION_PAGE_TYPE_ID,
                'section_id' => 2
            ],
            [
                'url' => 'disclaimer',
                'section_type' => PageSeeder::SECTION_PAGE_TYPE_ID,
                'section_id' => 3
            ]
        ]);

    }
}
