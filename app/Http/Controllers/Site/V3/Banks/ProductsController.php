<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\Banks\Bank;
//use App\Models\Banks\BankCategoryPage;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;

use App\Algorithms\General\Banks\ProductScaleNames;
use App\Algorithms\Frontend\Banks\ProductScaleRender;

use Config;
use Auth;

class ProductsController extends BaseBankController
{
    public function index($bankAlias)
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 1);
        $productAlias = request()->segment(count(request()->segments()));
        return $this->render($bankAlias, $categoryAlias, $productAlias);
    }

    public function amp($bankAlias)
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 2);
        $productAlias = request()->segment(count(request()->segments()) - 1);

        return $this->render($bankAlias, $categoryAlias, $productAlias, true);
    }


    private function render($bankAlias, $categoryAlias, $productAlias, $isAMP = false )
    {
        $bankAlias = clear_data($bankAlias);
        $bank = Bank::where(['alias' => $bankAlias,'status' => 1])
            ->whereNull('deleted_at')
            ->first();

        if ($bank == null) {
            abort(404);
        }

        $categoryAlias = clear_data($categoryAlias);

        $bankCategory = DB::table('bank_category_pages')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('bank_category_pages.*', 'cards_categories.breadcrumb as categoryBreadcrumb')
            ->where(['cards_categories.bank_alias' => $categoryAlias, 'bank_category_pages.bank_id' => $bank->id, 'bank_category_pages.status' => 1])
            ->whereNull('bank_category_pages.deleted_at')
            ->first();

        if ($bankCategory == null) {
            abort(404);
        }


        $productAlias = clear_data($productAlias);

            $page = DB::table('bank_products')
            ->where(['status' => 1, 'alias' => $productAlias, 'bank_category_id' => $bankCategory->id])
            ->whereNull('deleted_at')
            ->first();

        if ($page == null) {
            abort(404);
        }


        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banks'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->h1, 'link' => '/banks/'.$bank->alias];
        $breadcrumbs[] = ['h1' => $bankCategory->breadcrumb ?? $bankCategory->h1, 'link' => '/banks/'.$bank->alias.'/'.$categoryAlias];
        $breadcrumbs[] = ['h1' => $page->breadcrumb ?? $page->h1];



        $cardIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('cards.id','cards.category_id','banks.alias as bankAlias' ,'bank_products.alias as productAlias','bank_products.separate_page', 'cards_categories.bank_alias as categoryAlias')
            ->where(['bank_product_cards.bank_product_id' => $page->id])
            ->orderBy("cards.flow", 'desc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->get();



        $scaleNames = ProductScaleNames::getScalesByCategoryAlias($categoryAlias);
        $scales = ProductScaleRender::getScales($scaleNames, [$page]);


        $cards = CardsBoot::getCardsForListingByIDs($cardIDs);
        //$cards = $this->arrMerge($cards, $cardIDs);

        $section_type = null;

        $all_vzo_icons = Config::get('icons');
        $icons = [];
        foreach ($cards as $card) {
            $icons = array_merge($icons, explode(',', $card->icons));
        }
        $icons = array_unique($icons);

        $editLink = null;

        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_id' => $bank->id, 'bank_category_id' => $bankCategory->id])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();

        $bankTopCard = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.link_type','cards.link_1','cards.link_2','cards.title')
            ->where(['cards.status' => 1, 'banks.id' => $bank->id, 'bank_product_cards.bank_product_id' => $page->id])
            ->whereNull('bank_products.deleted_at')
            ->whereNull('bank_category_pages.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->first();


        $template = $isAMP === false
            ? 'frontend.banks.products.product'
            : 'frontend.banks.products.product-amp';

        return view($template, compact('breadcrumbs','page','bank','cards','section_type','scales', 'categoryAlias','all_vzo_icons','icons','reviews','editLink', 'bankTopCard'));
    }

    /*
    private function arrMerge($array1, $array2)
    {
        foreach ($array1 as $key => $item) {
            if (isset($array2[$key])) {
                $array1[$key]->productAlias = $array2[$key]->productAlias;
                $array1[$key]->bankAlias = $array2[$key]->bankAlias;
                $array1[$key]->categoryAlias = $array2[$key]->categoryAlias;
                $array1[$key]->separate_page = $array2[$key]->separate_page;

                $array1[$key]->linkToEntityReviews = '/banks/' . $array2[$key]->bankAlias . '/' . $array2[$key]->categoryAlias . '/reviews';
                //if ($array1[$key]->separate_page) {
                    //$array1[$key]->linkToEntity = '/banks/' . $array2[$key]->bankAlias . '/' . $array2[$key]->categoryAlias . '/' . $array2[$key]->productAlias;
                //}

            }

        }

        return $array1;
    }
    */

}