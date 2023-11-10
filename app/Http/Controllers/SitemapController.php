<?php

namespace App\Http\Controllers;

use App\Models\Banks\Bank;
use App\Models\Cards\Listing;
use App\Models\Companies\Companies;
use App\Models\Posts\PostsCategories;
use App\Models\StaticPages\StaticPage;
use DB;

class SitemapController extends Controller
{
    public function index()
    {
        return response()->view('site.xml-sitemap.index')->header('Content-type', 'text/xml');
    }

    public function staticPages()
    {
        $items = StaticPage::select('alias as url')->where('alias', '<>', '/')->get();

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }

    public function mfo()
    {
        $items = Companies::select(DB::raw('concat("mfo/", alias) as url'))->where(['status' => 1])->get();

        $children = DB::table('companies_children_pages')
            ->leftJoin('companies', 'companies.id', 'companies_children_pages.company_id')
            ->select(DB::raw('concat("mfo/", alias) as company_alias'),'companies_children_pages.type_id')
            ->where(['companies.status' => 1, 'companies_children_pages.status' => 1])
            ->get();

        foreach ($children as $child) {
            $aliasChild = $this->getAliasByChildPageTyprID($child->type_id);
            $items [] = (object) ['url' => $child->company_alias . '/' . $aliasChild];
        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }

    public function banks()
    {
        $items = Bank::where(['status' => 1])
            ->select(DB::raw('concat("banki/", alias) as url'))
            ->whereNull('deleted_at')
            ->get();

        $children = DB::table('bank_info_pages')
            ->leftJoin('banks', 'banks.id', 'bank_info_pages.bank_id')
            ->select(DB::raw('concat("banki/", banks.alias) as bank_alias'), 'bank_info_pages.type_id')
            ->where(['bank_info_pages.status' => 1, 'banks.status' => 1])
            ->whereNull('bank_info_pages.deleted_at')
            ->whereNull('banks.deleted_at')
            ->get();

        foreach ($children as $child) {
                $aliasChild = $this->getAliasByChildPageTyprID($child->type_id);
                $items [] = (object) ['url' => $child->bank_alias . '/' . $aliasChild];
        }


        $categories = DB::table('bank_category_pages')
            ->leftJoin('banks', 'banks.id', 'bank_category_pages.bank_id')
            ->select('bank_category_pages.id',DB::raw('concat("banki/", banks.alias) as bank_alias'), 'bank_category_pages.category_id')
            ->where(['bank_category_pages.status' => 1, 'banks.status' => 1])
            ->whereNull('bank_category_pages.deleted_at')
            ->whereNull('banks.deleted_at')
            ->groupBy('bank_category_pages.id', 'banks.id')
            ->get();

        foreach ($categories as $category) {
            $aliasCategory = $this->getAliasByCategoryID($category->category_id);
            if ($aliasCategory != '') {
                $items [] = (object) ['url' => $category->bank_alias . '/' . $aliasCategory];
            }
        }

        $products = \DB::table('bank_products')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('banks','banks.id','bank_products.bank_id')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select(DB::raw('concat("banki/", banks.alias) as bank_alias'), 'bank_category_pages.category_id', 'bank_products.alias')
            ->where(['bank_products.status' => 1, 'bank_category_pages.status' => 1, 'banks.status' => 1, 'bank_products.separate_page' => 1])
            ->whereNull('bank_products.deleted_at')
            ->whereNull('bank_products.deleted_at')
            ->whereNull('banks.deleted_at')
            ->get();

        foreach ($products as $product) {
            $aliasCategory = $this->getAliasByCategoryID($product->category_id);
            if ($aliasCategory != '') {
                $items [] = (object) ['url' => $product->bank_alias . '/' . $aliasCategory . '/' . $product->alias];
            }
        }


        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }

    public function blog()
    {
        $items = PostsCategories::select('id', 'sidebar_menu', 'alias_category as url')->get();
        $posts = DB::table('posts')
            ->leftJoin('posts_categories', 'posts_categories.id', 'posts.pcid')
            ->select('posts.alias', 'posts_categories.alias_category')
            ->where(['posts.status' => 1])
            ->get();

        foreach ($posts as $post) {
            if ($post->alias_category != null) {
                $items [] = (object) ['url' => $post->alias_category . '/' . $post->alias . '.html'];
            }
        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }


    public function listings()
    {
        $items = Listing::select('id', 'alias as url', 'category_id')->where(['status' =>1])->whereNull('deleted_at')->get();

        foreach ($items as $item) {
            $aliasListing = $this->getAliasByCategoryID($item->category_id);
            $items [] = (object) ['url' => $aliasListing . '/' . $item->url];
        }

        return response()->view('site.xml-sitemap.map', compact('items'))->header('Content-type', 'text/xml');
    }


    private function getAliasByCategoryID(int $categoryID) : string
    {
        return match($categoryID) {
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
    }

    private function getAliasByChildPageTyprID(int $typeID) : string
    {
        return match($typeID) {
            1 => 'gorjachaja-linija',
            2 => 'lichnyj-kabinet',
            4 => 'otzyvy',
            5 => 'requisites',
            default => ''
        };
    }


    public function style(){
        return response()->view('site.xml-sitemap.style')->header('Content-type', 'text/xml');
    }
}