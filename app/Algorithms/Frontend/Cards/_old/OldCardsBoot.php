<?php

namespace App\Algorithms\Frontend\Cards;
use App\Models\Cards\Cards;
use App\Models\Companies\CompaniesReviews;
use DB;
use App\Algorithms\Frontend\Cards\CardTable;

class OldCardsBoot
{
    public static function getCardsForListingByCompanyID($company_id)
    {
        $cards = DB::select("select id, category_id, status from cards where company_id=$company_id or company_id2=$company_id");

        if(!empty($cards)){

            foreach ($cards as $key => $value) {
                $table_name = CardTable::getNameById($value->category_id);

                $item = DB::table('cards')
                    ->leftjoin($table_name,'cards.id', $table_name.'.card_id')
                    ->where('cards.id',$value->id)
                    ->first();

                $cards[$key] = $item;
            }

            return $cards;

        }

        return [];

    }


}