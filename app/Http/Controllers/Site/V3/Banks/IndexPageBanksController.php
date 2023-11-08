<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\Options\Options;
use App\Models\StaticPages\StaticPage;
use DB;

use App\Models\Banks\BankInfoPage;
use App\Models\Banks\BankCategoryPage;
use App\Models\Banks\BankProduct;
use App\Models\Banks\BankProductCard;
use App\Models\Banks\BankCategoryReviewsPage;

use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Banks\BankReviews;
use Cache;

use App\Models\Cards\Cards;

class IndexPageBanksController extends BaseBankController
{
    public function index()
    {
        return $this->render();
    }


    public function amp()
    {
        return $this->render();
    }

    private function render()
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs [] = ['h1' => $page->breadcrumb ?? $page->h1];


        $banks = DB::table('banks')->where(['status' => 1])->whereNull('deleted_at')->get();

        $banks = BankReviews::reviewsParse($banks);

        $cardCategories = DB::table('cards_categories')->get();

        $editLink = null;

        $cardsRKOIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 2])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->limit(3)
            ->get();

        $cardsRKO = CardsBoot::getCardsForListingByIDs($cardsRKOIDs);
        $cardsRKO = $this->arrMerge($cardsRKO, $cardsRKOIDs);


        $cardsCreditsIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 4])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->limit(3)
            ->get();
        $cardsCredits = CardsBoot::getCardsForListingByIDs($cardsCreditsIDs);
        $cardsCredits = $this->arrMerge($cardsCredits, $cardsCreditsIDs);

        $cardsCreditCardsIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 5])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->limit(3)
            ->get();
        $cardsCreditCards = CardsBoot::getCardsForListingByIDs($cardsCreditCardsIDs);
        $cardsCreditCards = $this->arrMerge($cardsCreditCards, $cardsCreditCardsIDs);

        $cardsDebitCardsIds = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 6])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->limit(3)
            ->get();
        $cardsDebitCards = CardsBoot::getCardsForListingByIDs($cardsDebitCardsIds);
        $cardsDebitCards = $this->arrMerge($cardsDebitCards, $cardsDebitCardsIds);


        $cardsMortgageIds = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 10])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->limit(3)
            ->get();
        $cardsMortgage = CardsBoot::getCardsForListingByIDs($cardsMortgageIds);
        $cardsMortgage = $this->arrMerge($cardsMortgage, $cardsMortgageIds);

        $cardsDepositIds = Cache::remember('cardsDepositIds', 20, function () {
            return DB::table('bank_product_cards')
                ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
                ->leftJoin('banks','banks.id', 'bank_products.bank_id')
                ->leftJoin('cards','cards.id','bank_product_cards.card_id')
                ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias','banks.name as bankName')
                ->where(['cards.category_id' => 11])
                ->whereNull('bank_products.deleted_at')
                ->orderBy("cards.flow", 'asc')
                ->orderBy("cards.km5", 'desc')
                ->orderBy("cards.id", 'asc')
                ->limit(3)
                ->get();
        });
        $cardsDeposits = CardsBoot::getCardsForListingByIDs($cardsDepositIds);
        $cardsDeposits = $this->arrMerge($cardsDeposits, $cardsDepositIds);


        $reviews =  DB::table('bank_reviews')
            ->leftjoin('banks','banks.id','bank_reviews.bank_id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias')
            ->where(['bank_reviews.status' => 1, 'bank_reviews.off_answer' => null])
            ->where('bank_reviews.bank_id','!=',0)
            ->whereNotNull('bank_reviews.bank_id')
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.id','desc')
            ->limit(10)
            ->get();


        $template = ! is_amp_page()
            ? 'site.v3.templates.banks.index'
            : 'site.v3.templates.banks.index-amp';

        return view($template,compact('page','breadcrumbs','banks','cardCategories', 'editLink',
            'cardsRKO', 'cardsCredits', 'cardsCreditCards', 'cardsDebitCards', 'cardsMortgage', 'cardsDeposits', 'reviews'
        ));
    }

    private function arrMerge($array1, $array2)
    {
        foreach ($array1 as $key => $item) {
            if (isset($array2[$key])) {
                $array1[$key]->productAlias = $array2[$key]->productAlias;
                $array1[$key]->bankAlias = $array2[$key]->bankAlias;
                $array1[$key]->separate_page = $array2[$key]->separate_page;
            }
        }

        return $array1;
    }




}
