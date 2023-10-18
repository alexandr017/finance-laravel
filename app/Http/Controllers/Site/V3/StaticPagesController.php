<?php

namespace App\Http\Controllers\Site\V3;

use App\Http\Controllers\Controller;
use DB;

class StaticPagesController extends Controller
{
    public function about()
    {
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

        return view('frontend.about',compact(
            'page', 'breadcrumbs',
            'all_products_count', 'all_reviews_count', 'users_count', 'we_help_count'
        ));
    }

}
