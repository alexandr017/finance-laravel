<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\Banks\Bank;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\General\Banks\ProductScaleNames;
use App\Algorithms\Frontend\Banks\ProductScaleRender;
use Config;
use App\Models\Banks\BankCategoryReviewsPage;
use Illuminate\Contracts\View\View;

class CategoryController extends BaseBankController
{
    public function index($bankAlias) : View
    {
        $categoryAlias = request()->segment(count(request()->segments()));
        return $this->render($bankAlias, $categoryAlias);
    }

    public function amp($bankAlias) : View
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 1);
        return $this->render($bankAlias, $categoryAlias, true);
    }


    private function render($bankAlias, $categoryAlias, $isAMP = false) : View
    {
        $bankAlias = clear_data($bankAlias);
        $bank = Bank::where(['alias' => $bankAlias,'status' => 1])
            ->whereNull('deleted_at')
            ->first();

        if ($bank == null) {
            abort(404);
        }

        $categoryAlias = clear_data($categoryAlias);
        $page = DB::table('bank_category_pages')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('bank_category_pages.*', 'cards_categories.breadcrumb as categoryBreadcrumb')
            ->where(['cards_categories.bank_alias' => $categoryAlias, 'bank_category_pages.bank_id' => $bank->id, 'bank_category_pages.status' => 1])
            ->whereNull('bank_category_pages.deleted_at')
            ->first();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->h1, 'link' => '/banki/'.$bank->alias];
        $breadcrumbs[] = ['h1' => $page->breadcrumb ?? $page->h1];


        $cardIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('cards.id','cards.category_id','banks.alias as bankAlias' ,'bank_products.alias as productAlias','bank_products.separate_page', 'cards_categories.bank_alias as categoryAlias')
            ->where(['bank_products.bank_category_id' => $page->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->get();


        $cardIDs = $cardIDs->unique('id');
        $cards = CardsBoot::getCardsForListingByIDs($cardIDs);

        $products = DB::table('bank_products')
            ->where(['bank_products.bank_category_id' => $page->id])
            ->whereNull('deleted_at')
            ->get();



        $scaleNames = ProductScaleNames::getScalesByCategoryAlias($categoryAlias);



        if ($page->scale_1 != null) {
            $products = [];
            $products [] = (object) [
                'scale_1' => $page->scale_1,
                'scale_2' => $page->scale_2,
                'scale_3' => $page->scale_3,
                'scale_4' => $page->scale_4,
                'scale_5' => $page->scale_5
            ];

        }

        $scales = ProductScaleRender::getScales($scaleNames, $products);

        $all_vzo_icons = Config::get('icons');
        $icons = [];
        foreach ($cards as $card) {
            $icons = array_merge($icons, explode(',', $card->icons));
        }
        $icons = array_unique($icons);


        if ($page->category_id == 9) {


            $reviews = DB::table('bank_reviews')
                ->leftjoin('bank_products','bank_reviews.product_id','bank_products.id')
                ->select('bank_reviews.*')
                ->where(['bank_reviews.status' => 1, 'bank_reviews.bank_id' => $bank->id, 'bank_products.is_cashback' => 1])
                ->whereNull('bank_reviews.deleted_at')
                ->orderBy('bank_reviews.id', 'desc')
                ->get();

        } else {
            $reviews = DB::table('bank_reviews')
                ->select('*')
                ->where(['status' => 1, 'bank_id' => $bank->id, 'bank_category_id' => $page->id])
                ->whereNull('deleted_at')
                ->orderBy('id', 'desc')
                ->get();
        }

        $editLink = null;


        $bankTopCard = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.link_type','cards.link_1','cards.link_2','cards.title')
            ->where(['cards.status' => 1, 'banks.id' => $bank->id, 'bank_products.bank_category_id' => $page->id])
            ->whereNull('bank_products.deleted_at')
            ->whereNull('bank_category_pages.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->first();


        $reviewsPage = BankCategoryReviewsPage::where(['bank_category_page_id' => $page->id, 'status' => 1])->first();



        $template = $isAMP === false
            ? 'site.v3.templates.banks.categories.category'
            : 'site.v3.templates.banks.categories.category-amp';

        return view($template, compact('breadcrumbs','page','bank','cards','scales','categoryAlias','all_vzo_icons','icons','reviews','editLink', 'bankTopCard','reviewsPage'));
    }


}