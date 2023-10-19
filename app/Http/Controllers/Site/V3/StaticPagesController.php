<?php

namespace App\Http\Controllers\Site\V3;

use App\Http\Controllers\Controller;
use App\Models\Cards\CardsCategories;
use DB;

class StaticPagesController extends Controller
{
    public function about()
    {

//        $categories = CardsCategories::all();
//        foreach ($categories as $_category) {
//            $category = CardsCategories::find($_category->id);
//            if ($_category->id == 4) $category->bank_alias = 'kredity';
//            if ($_category->id == 5) $category->bank_alias = 'kreditnye-karty';
//            if ($_category->id == 5) $category->bank_alias = 'debetovye-karty';
//            if ($_category->id == 10) $category->bank_alias = 'ipotekay';
//            if ($_category->id == 8) $category->bank_alias = 'avtokredity';
//            if ($_category->id == 11) $category->bank_alias = 'vklady';
//            $category->save();
//        }
//
        $page = (object) [
          'title' => 'О нас',
            'meta_description' => '',
            'h1' => 'О нас',
            'content' => 'О нас content'
        ];

        $breadcrumbs = [['h1' => 'О нас']];

        $all_products_count = 0;
        $companies_count = DB::select("select count(id) as count from companies where status=1");
        $bank_products_count = DB::select("select count(id) as count from bank_products where status=1");
        $all_products_count += $companies_count[0]->count;
        $all_products_count += $bank_products_count[0]->count;
        $all_reviews_count = 0;
        $companies_reviews_count = DB::select("select count(id) as count from companies_reviews where status=1");
        $banks_reviews_count = DB::select('select count(id) as count from bank_reviews where status=1');
        $all_reviews_count += $companies_reviews_count[0]->count;
        $all_reviews_count += $banks_reviews_count[0]->count;            $users_count = DB::select("select count(*) as count from users");
        $we_help_count = DB::select("select * from sidebar where id=1");

        return view('site.v3.templates.static-pages.about',compact(
            'page', 'breadcrumbs',
            'all_products_count', 'all_reviews_count', 'users_count', 'we_help_count'
        ));
    }

}
