<?php

namespace App\Http\Controllers\Site\V3\Banks\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Algorithms\Frontend\Cards\CardsBoot;
use DB;

class BankLoadProductActionController extends Controller
{
    public function loadCardsForCategory(Request $request)
    {
        $pageID = (int) clear_data($request['item_id']);

        $page = DB::table('bank_category_pages')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('bank_category_pages.*', 'cards_categories.breadcrumb as categoryBreadcrumb')
            ->where(['bank_category_pages.id' => $pageID, 'bank_category_pages.status' => 1])
            ->whereNull('bank_category_pages.deleted_at')
            ->first();

        if ($page == null) {
            abort(404);
        }

        $cardIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('cards.id','cards.category_id','banks.alias as bankAlias' ,'bank_products.alias as productAlias','bank_products.separate_page', 'cards_categories.bank_alias as categoryAlias')
            ->where(['bank_products.bank_category_id' => $pageID])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->get();

        $cardIDs = $cardIDs->unique('id');

        $cards = CardsBoot::getCardsForListingByIDs($cardIDs);



        /*
        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_category_id' => $pageID])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();
*/


        //$cards = $this->arrMerge($cards, $cardIDs);

        $code = '';
        $amp = 0;

        foreach ($cards as $key => $card) {
            $code .= view('frontend.cards.card.card', compact('card','amp'))->render();
        }

        return ['code' => $code];

    }


    public function loadCardsForProduct(Request $request)
    {
        $pageID = (int) clear_data($request['item_id']);

        $cardIDs = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('cards.id','cards.category_id','banks.alias as bankAlias' ,'bank_products.alias as productAlias','bank_products.separate_page', 'cards_categories.bank_alias as categoryAlias')
            ->where(['bank_products.id' => $pageID])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->get();


        $cards = CardsBoot::getCardsForListingByIDs($cardIDs);

        $code = '';
        $amp = 0;
        $hideEntityLink = true;

        foreach ($cards as $key => $card) {
            $code .= view('frontend.cards.card.card', compact('card','amp', 'hideEntityLink'))->render();
        }

        return ['code' => $code];
    }


}