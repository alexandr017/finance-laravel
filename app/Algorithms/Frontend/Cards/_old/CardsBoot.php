<?php

namespace App\Algorithms\Frontend\Cards;
use App\Models\Cards\Cards;
use App\Models\Companies\CompaniesReviews;
use DB;
use Cache;
use App\Algorithms\Frontend\Cards\CardTable;
use Auth;

class CardsBoot
{
    public static function getCardsForListingByIDs($IDs)
    {
        $cards = [];

        foreach($IDs as $id){

            // взятие полей карточки
            //$card = Cache::rememberForever('card'.$id, function() use($id){

            $card_ = DB::table('cards')
                ->where(['cards.id' => $id])
                ->select('category_id','status')
                ->first();


            if($card_ == null) continue;
            
            if(!$card_->status) continue;

                $table_name = CardTable::getNameById($card_->category_id);
                $card_ = DB::table('cards')
                    ->leftjoin('companies','companies.id', 'cards.company_id')
                    ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
                    ->leftjoin($table_name,'cards.id', $table_name.'.card_id')
                    ->where(['cards.id' => $id])
                    ->select("$table_name.*","cards.*", 'companies.alias as companies_alias', 'companies.reviews_page', 'companies_url.url as group_url')
                    ->first();

                //return $card_;
            //});
            $card = $card_;

            // расчет рейтинга для карточки по привязанной компании
            if ($card->company_id != null && $card->company_id2 != null) {

                $company_id = ($card->company_id != null) ? $card->company_id : $card->company_id2;

                $rating = Cache::rememberForever('company_reviews'.$company_id, function() use($company_id){

                    $reviews = DB::table("companies_reviews")
                        ->select(DB::raw('avg(rating) as avg_rating'), DB::raw('count(rating) as count_rating'))
                        ->where(['company_id' => $company_id, 'status' => 1])
                        ->whereNotNull('rating')
                        ->first();

                    if ($reviews->avg_rating != null) {
                        return [
                            'ratingValue' => round($reviews->avg_rating,2),
                            'ratingCount' => $reviews->count_rating
                        ];
                    } else {
                        return [
                            'ratingValue' => 0,
                            'ratingCount' => 0
                        ];
                    }

                });

                $card->ratingValue = $rating['ratingValue'];
                $card->ratingCount = $rating['ratingCount'];

            } else {
                $card->ratingValue = null;
                $card->ratingCount = null;
            }

            $cards[] = $card;

        }

        return collect($cards);
    }












    public static function getFullCardsByIdAndCategory($cards)
    {
        $cards = [];

        foreach($cards as $card){

            // взятие полей карточки
            //$card = Cache::rememberForever('card'.$id, function() use($id){

            $table_name = CardTable::getNameById($card->category_id);
            $card_ = DB::table('cards')
                ->leftjoin('companies','companies.id', 'cards.company_id')
                ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
                ->leftjoin($table_name,'cards.id', $table_name.'.card_id')
                ->where(['cards.id' => $card->id])
                ->select("$table_name.*","cards.*", 'companies.alias as companies_alias', 'companies.reviews_page', 'companies_url.url as group_url')
                ->first();

            //return $card_;
            //});

            // расчет рейтинга для карточки по привязанной компании
            if ($card_->company_id != null && $card_->company_id2 != null) {

                $company_id = ($card_->company_id != null) ? $card_->company_id : $card_->company_id2;

                $rating = Cache::rememberForever('company_reviews'.$company_id, function() use($company_id){

                    $reviews = DB::table("companies_reviews")
                        ->select(DB::raw('avg(rating) as avg_rating'), DB::raw('count(rating) as count_rating'))
                        ->where(['company_id' => $company_id, 'status' => 1])
                        ->whereNotNull('rating')
                        ->first();

                    if ($reviews->avg_rating != null) {
                        return [
                            'ratingValue' => round($reviews->avg_rating,2),
                            'ratingCount' => $reviews->count_rating
                        ];
                    } else {
                        return [
                            'ratingValue' => 0,
                            'ratingCount' => 0
                        ];
                    }

                });

                $card->ratingValue = $rating['ratingValue'];
                $card->ratingCount = $rating['ratingCount'];

            } else {
                $card->ratingValue = null;
                $card->ratingCount = null;
            }

            $cards[] = $card;

        }

        return collect($cards);
    }

}