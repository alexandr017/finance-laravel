<?php

namespace App\Repositories\Site\Companies;

use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Models\Cards\Cards;
use App\Repositories\Repository;
use App\Models\Companies\CompaniesCategories;
use Cache;
use DB;

class CompaniesCategoryRepository extends Repository
{

    public function getAllCategoryFromCacheById($category_id){
        $companies_categories = Cache::rememberForever('companies_categories', function(){
            return CompaniesCategories::all();
        });

        foreach ($companies_categories as $value) {
            if($value->id == $category_id){
                return $value;
            }
        }

        return null;
    }


    public function getCardsForHabPages($cardCategoryID)
    {
        $cards = DB::table('cards')
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
        $cards = Cards::where(['cards.show_in_habs' => 1,'cards.category_id' => $cardCategoryID, 'cards.status' => 1])
                ->select('id','category_id')
                ->orderBy('flow')
                ->orderBy($field,$sort)
                ->orderBy('cards.id','asc')
                ->get();


        return  CardsBoot::getCardsForListingByIDs($cards);
    }

}