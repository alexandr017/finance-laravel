<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SeoForPageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('seo_for_pages')->insert([
            [ // index page
                'title' => 'index',
                'meta_description'  => 'index',
                'h1'  => 'index',
                'breadcrumbs' => 'index',
                'lead' => 'index',
                'content' => 'index',
            ],

            [ // about
                'title' => 'Все о сервисе Курсы.ру: команда, преимущества и партнеры',
                'meta_description'  => 'Все о сервисе Курсы.ру: команда, преимущества и партнеры',
                'h1'  => 'О нас',
                'breadcrumbs' => 'О нас',
                'lead' => 'Курсы.ру — агрегатор онлайн-образования.<br>Мы подбираем и сравниваем лучшие онлайн-курсы в разных направлениях. Здесь вы найдете подходящий курс, который поможет вам стать специалистом в выбранной сфере.',
                'content' => null,
            ],

        ]);
    }
}
