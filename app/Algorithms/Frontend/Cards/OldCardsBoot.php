<?php

namespace App\Algorithms\Frontend\Cards;

use DB;

class OldCardsBoot
{
    public static function getCardsForListingByCompanyID($company_id)
    {
        //$cards = DB::select("select id, category_id, status, company_id, company_id2 from cards where company_id=$company_id or company_id2 like '%$company_id%' order by km5 desc");
        $cards = DB::select("select id, category_id, status, company_id, company_id2 from cards where company_id=$company_id or company_id2 like '%$company_id%'order by category_id asc, km5 desc");

        // TODO переписать
        foreach ($cards as $key => $value) {
            if ($value->company_id == $company_id) {
                continue;
            }
            $cards_company_id2 = explode(',',$value->company_id2);
            $isset_card = false;
            foreach ($cards_company_id2 as $v) {
                if($v == $company_id) {
                    continue 2;
                }
            }
            if (! $isset_card) {
                unset($cards[$key]);
            }
        }


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