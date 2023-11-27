<?php

namespace App\Http\Controllers\Site\V3\Banks;

use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;
use Illuminate\Contracts\View\View;
use App\Repositories\Site\Bank\BankRepository;

class BankController extends BaseBankController
{
    public function render(string $bankAlias) : View
    {
        $bankAlias = clear_data($bankAlias);
        $bank = (new BankRepository)->getBankByAlias($bankAlias);
        if ($bank == null) {
            abort(404);
        }

        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_id' => $bank->id])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();

        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->h1];

        $editLink = null;

        $cardsRKOIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 2, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit(3)
            ->get();
        $cardsRKO = CardsBoot::getCardsForListingByIDs($cardsRKOIDs);
        $cardsRKO = $this->arrMerge($cardsRKO, $cardsRKOIDs);

        $cardsCreditsIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 4, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit(3)
            ->get();
        $cardsCredits = CardsBoot::getCardsForListingByIDs($cardsCreditsIDs);
        $cardsCredits = $this->arrMerge($cardsCredits, $cardsCreditsIDs);


        $cardsCreditCardsIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 5, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit(3)
            ->get();
        $cardsCreditCards = CardsBoot::getCardsForListingByIDs($cardsCreditCardsIDs);
        $cardsCreditCards = $this->arrMerge($cardsCreditCards, $cardsCreditCardsIDs);

        $cardsDebitCardsIds = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 6, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit(3)
            ->get();
        $cardsDebitCards = CardsBoot::getCardsForListingByIDs($cardsDebitCardsIds);
        $cardsDebitCards = $this->arrMerge($cardsDebitCards, $cardsDebitCardsIds);


        $cardsMortgageIds = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 10, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit(3)
            ->get();
        $cardsMortgage = CardsBoot::getCardsForListingByIDs($cardsMortgageIds);
        $cardsMortgage = $this->arrMerge($cardsMortgage, $cardsMortgageIds);


        $cardsDepositsIds = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 11, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit(3)
            ->get();
        $cardsDeposits = CardsBoot::getCardsForListingByIDs($cardsDepositsIds);
        $cardsDeposits = $this->arrMerge($cardsDeposits, $cardsDepositsIds);

        return view('site.v3.templates.banks.banks.bank',['page' => $bank], compact('breadcrumbs','bank','reviews','editLink',
            'cardsRKO', 'cardsCredits', 'cardsCreditCards', 'cardsDebitCards', 'cardsMortgage', 'cardsDeposits'
        ));
    }
}