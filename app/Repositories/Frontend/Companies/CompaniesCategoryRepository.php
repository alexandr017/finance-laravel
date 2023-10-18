<?php

namespace App\Repositories\Frontend\Companies;

use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Models\Cards\Cards;
use App\Repositories\Repository;
use App\Models\Companies\CompaniesCategories;
use App\Models\Cards\CardsCategories as Model;
use Cache;
use DB;
use Auth;

class CompaniesCategoryRepository extends Repository
{
    private $CASH_BACK_CATEGORY = 9;

    public function getAllCategoryFromCacheById($category_id){
        $companies_categories = Cache::rememberForever('companies_categories', function(){
            return CompaniesCategories::all();
        });

        foreach ($companies_categories as $key => $value) {
            if($value->id == $category_id){
                return $value;
            }
        }

        return null;
    }


    public function getCardsForHabPages($cardCategoryID)
    {
        $cards = ($cardCategoryID != $this->CASH_BACK_CATEGORY)
            ? Cards::where(['cards.show_in_habs' => 1,'cards.category_id' => $cardCategoryID, 'cards.status' => 1])
                ->select('id','category_id')
                ->orderBy('flow')
                ->orderBy('km5','desc')
                ->orderBy('cards.id','asc')
                ->get()
            : DB::table('cards')
                ->leftJoin('bank_product_cards', 'bank_product_cards.card_id', 'cards.id')
                ->leftJoin('bank_products', 'bank_products.id', 'bank_product_cards.bank_product_id')
                ->where(['cards.show_in_habs' => 1, 'bank_products.is_cashback' => 1, 'cards.status' => 1])
                ->select('cards.id','category_id')
                ->orderBy('cards.flow')
                ->orderBy('cards.km5','desc')
                ->orderBy('cards.id','asc')
                ->get();

        return  CardsBoot::getCardsForListingByIDs($cards);
    }

    public function getSortedCardsForHabPages($cardCategoryID, $field = 'km5', $sort = 'desc')
    {
        $cards = ($cardCategoryID != $this->CASH_BACK_CATEGORY)
            ? Cards::where(['cards.show_in_habs' => 1,'cards.category_id' => $cardCategoryID, 'cards.status' => 1])
                ->select('id','category_id')
                ->orderBy('flow')
                ->orderBy($field,$sort)
                ->orderBy('cards.id','asc')
                ->get()
            : DB::table('cards')
                ->leftJoin('bank_product_cards', 'bank_product_cards.card_id', 'cards.id')
                ->leftJoin('bank_products', 'bank_products.id', 'bank_product_cards.bank_product_id')
                ->where(['cards.show_in_habs' => 1, 'bank_products.is_cashback' => 1, 'cards.status' => 1])
                ->select('cards.id','category_id')
                ->orderBy('cards.flow')
                ->orderBy('cards.km5','desc')
                ->orderBy('cards.id','asc')
                ->get();

        return  CardsBoot::getCardsForListingByIDs($cards);
    }

}