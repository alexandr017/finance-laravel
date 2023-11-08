<?php

namespace App\Http\Controllers;

use App\Models\Banks\Bank;
use App\Models\Banks\BankCategoryPage;
use App\Models\Banks\BankInfoPage;
use App\Models\Banks\BankProduct;
use App\Models\Cards\Listing;
use App\Models\Companies\Companies;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Posts\Posts;
use App\Models\Posts\PostsCategories;
use App\Models\StaticPages\StaticPage;

class SitemapController extends Controller
{
    public function index()
    {
        return response()->view('site.xml-sitemap.index')->header('Content-type', 'text/xml');
    }

    public function staticPages()
    {
        $items = StaticPage::select('alias as url')->get();

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }

    public function mfo()
    {
        $items = Companies::select('id', 'alias as url')->get();

        foreach ($items as $k => $item) {
            $items[$k]->url = 'mfo/' . $item->url;

            $children = CompaniesChildrenPages::select('type_id')
                ->where(['status' => 1, 'company_id' => $item->id])
                ->get();

            foreach ($children as $child) {
                $aliasChild = match($child->type_id) {
                    1 => 'gorjachaja-linija',
                    2 => 'lichnyj-kabinet',
                    4 => 'otzyvy',
                    default => ''
                };
                $items [] = (object) ['url' => $item->url . '/' . $aliasChild];
            }
        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }

    public function banks()
    {
        $items = Bank::where(['status' => 1])
            ->select('id','alias as url','updated_at')
            ->whereNull('deleted_at')
            ->get();

        foreach ($items as $k => $item) {
            $items[$k]->url = 'banki/' . $item->url;


            $children = BankInfoPage::select('type_id')
                ->where(['status' => 1, 'bank_id' => $item->id])
                ->whereNull('deleted_at')
                ->get();

            foreach ($children as $child) {
                $aliasChild = match($child->type_id) {
                    1 => 'gorjachaja-linija',
                    2 => 'lichnyj-kabinet',
                    4 => 'otzyvy',
                    5 => 'requisites',
                    default => ''
                };
                $items [] = (object) ['url' => $item->url . '/' . $aliasChild];
            }


            $categories = BankCategoryPage::select('id', 'category_id')
                ->where(['status' => 1, 'bank_id' => $item->id])
                ->whereNull('deleted_at')
                ->get();

            foreach ($categories as $category) {
                $aliasCategory = match($category->category_id) {
                    2 => 'rko',
                    4 => 'kredity',
                    5 => 'kreditnye-karty',
                    6 => 'debetovye-karty',
                    8 => 'avtokredity',
                    10 => 'ipoteka',
                    11 => 'vklady',
                    default => ''
                };
                $items [] = (object) ['url' => $item->url . '/' . $aliasCategory];


                $products = \DB::table('bank_products')
                    ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
                    ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
                    ->select('bank_products.id','bank_products.updated_at','bank_products.alias', 'cards_categories.bank_alias as category_alias')
                    ->where(['bank_products.bank_id' => $item->id, 'bank_products.status' => 1, 'bank_category_pages.status' => 1, 'bank_products.separate_page' => 1])
                    ->whereNull('bank_products.deleted_at')
                    ->whereNull('bank_category_pages.deleted_at')
                    ->get();

                foreach ($products as $product) {
                    $items [] = (object) ['url' => $item->url . '/' . $product->category_alias . '/' . $product->alias];
                }

            }

        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }

    public function blog()
    {
        $items = PostsCategories::select('id', 'sidebar_menu', 'alias_category as url')->get();

        foreach ($items as $k => $item) {
//            $blogPrefix = 'news';
//            if ($item->sidebar_menu == 2) {
//                $blogPrefix = 'articles';
//            }

            $items[$k]->url =  $item->url;

            $posts = Posts::select('alias')
                ->where(['status' => 1, 'pcid' => $item->id])
                ->get();

            foreach ($posts as $post) {
                $items [] = (object) ['url' => $item->url . '/' . $post->alias . '.html'];
            }

        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }


    public function listings()
    {
        $items = Listing::select('id', 'alias as url', 'category_id')->where(['status' =>1])->whereNull('deleted_at')->get();

        foreach ($items as $item) {
            $aliasListing = match($item->category_id) {
                1 => 'zaimy',
                2 => 'rko',
                4 => 'kredity',
                5 => 'kreditnye-karty',
                6 => 'debetovye-karty',
                8 => 'avtokredity',
                10 => 'ipoteka',
                11 => 'vklady',
                default => ''
            };
            $items [] = (object) ['url' => $aliasListing . '/' . $item->url];
        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }



    public function style(){
        return response()->view('site.xml-sitemap.style')->header('Content-type', 'text/xml');
    }
}