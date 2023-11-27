<?php

namespace App\Algorithms;

use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;

class SimilarCompanies {

    public static function getSimilarCards($card)
    {
        $cardsRow = DB::table('cards')
            ->leftjoin('companies', 'companies.id', 'cards.company_id')
            ->select('cards.id','cards.km5', 'cards.company_id', 'cards.category_id')
            ->where(['cards.category_id' => $card->category_id, 'cards.status' => 1, 'companies.closed' => 0, 'cards.show_in_habs' => 1])
            ->where('cards.id', '!=', $card->id)
            ->where('cards.company_id', '!=', $card->company_id)
            ->orderBy('cards.km5', 'desc')
            ->get();

        $cardsRow = $cardsRow->sort(function($a, $b) use ($card){
            $cardK5m = (float) $card->km5;
            return ceil(abs((float) $a->km5 - $cardK5m) - abs((float) $b->km5 - $cardK5m));
        })->take(7)->shuffle()->take(3);

        return CardsBoot::getCardsForListingByIDs($cardsRow);
    }
}



