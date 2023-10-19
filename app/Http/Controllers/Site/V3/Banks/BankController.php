<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\Banks\Bank;

use Request;
use Cache;

use App\Models\HideLinks\HideLinks;
use App\Models\HideLinks\HideLinkTimes;

use App\Models\Banks\BankInfoPages;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;

class BankController extends BaseBankController
{
    public function index($bankAlias)
    {
        $resUrl = str_replace('https://finance.ru/', '', Request::url());
        $hideLink = HideLinks::where(['in'=>$resUrl])->first();
        if($hideLink != null){
            $hideLink = hideLinks::find($hideLink->id);
            $hideLink->increment('clicks');
            if(Cache::has('hide_links')) Cache::forget('hide_links');
            $hideLinkTime = new HideLinkTimes();
            $hideLinkTime->hlid = $hideLink->id;
            $hideLinkTime->save();
            //ddd('обычная', $hideLink->straight);
            return redirect($hideLink->straight, $hideLink->redirect_type);
        }

        $bankAlias = clear_data($bankAlias);
        $bank = Bank::where(['alias' => $bankAlias,'status' => 1])
            ->whereNull('deleted_at')
            ->first();

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
            ->where(['cards.category_id' => 4, 'bank_products.bank_id' => $bank->id])
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
            ->where(['cards.category_id' => 5, 'bank_products.bank_id' => $bank->id])
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
            ->where(['cards.category_id' => 6, 'bank_products.bank_id' => $bank->id])
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
        ->where(['cards.category_id' => 10, 'bank_products.bank_id' => $bank->id])
        ->whereNull('bank_products.deleted_at')
        ->orderBy("cards.flow", 'asc')
        ->orderBy("cards.km5", 'desc')
        ->orderBy("cards.id", 'asc')
        ->limit(3)
        ->get();
        $cardsMortgage = CardsBoot::getCardsForListingByIDs($cardsMortgageIds);
        $cardsMortgage = $this->arrMerge($cardsMortgage, $cardsMortgageIds);

        return view('site.v3.templates.banks.banks.bank',['page' => $bank], compact('breadcrumbs','bank','reviews','editLink',
            'cardsRKO', 'cardsCredits', 'cardsCreditCards', 'cardsDebitCards', 'cardsMortgage'
        ));
    }

    public function amp($bankAlias)
    {
        $bankAlias = clear_data($bankAlias);
        $bank = Bank::where(['alias' => $bankAlias,'status' => 1])
            ->whereNull('deleted_at')
            ->first();

        if ($bank == null) {
            abort(404);
        }

        $news = DB::table('posts')
            ->leftJoin('posts_categories', 'posts.pcid','posts_categories.id')
            ->select('posts.*', 'posts_categories.alias_category as categoryAlias')
            ->whereIn('posts.pcid',[13,28])
            ->where(['bank_id' => $bank->id])
            ->orderBy('posts.date','desc')
            ->limit(3)
            ->get();

        /*
        $newsBase = DB::table('posts')
            ->leftJoin('posts_categories', 'posts.pcid','posts_categories.id')
            ->select('posts.*', 'posts_categories.alias_category as categoryAlias')
            ->where(['posts.pcid' => 15])
            //->where(['bank_id' => $bank->id]) // !!! убрать
            ->orderBy('posts.date','desc')
            ->limit(3)
            ->get();
        */

        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_id' => $bank->id])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();


        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->h1];


        $cardsRKOIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 2,'cards.status' => 1, 'bank_products.bank_id' => $bank->id])
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
            ->select('cards.id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 4,'cards.status' => 1, 'bank_products.bank_id' => $bank->id])
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
            ->select('cards.id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 5,'cards.status' => 1, 'bank_products.bank_id' => $bank->id])
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
            ->select('cards.id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where(['cards.category_id' => 6,'cards.status' => 1, 'bank_products.bank_id' => $bank->id])
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
            ->where(['cards.category_id' => 10, 'bank_products.bank_id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->limit(3)
            ->get();
        $cardsMortgage = CardsBoot::getCardsForListingByIDs($cardsMortgageIds);
        $cardsMortgage = $this->arrMerge($cardsMortgage, $cardsMortgageIds);

        return view('site.v3.templates.banks.banks.bank-amp',['page' => $bank], compact('breadcrumbs','bank','reviews',
            'cardsRKO', 'cardsCredits', 'cardsCreditCards', 'cardsDebitCards', 'cardsMortgage'
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