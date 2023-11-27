<?php

namespace App\Algorithms\Frontend\Cards;

use App\Algorithms\Frontend\Banks\BankReviews;
use DB;
use Cache;
use App\Repositories\Site\Companies\CompaniesReviewRepository;

class CardsBoot
{
    public static function getCardsForListingByIDs($IDs)
    {
        $cards = [];
        foreach($IDs as $card_row){
            // взятие полей карточки
            $card = Cache::rememberForever('card'.$card_row->id, function() use($card_row){

                $table_name = CardTable::getNameById($card_row->category_id);
                $card_ = DB::table('cards')
                    ->leftjoin('companies','companies.id', 'cards.company_id')
                    ->leftjoin($table_name,'cards.id', $table_name.'.card_id')
                    ->leftJoin('cards_filters', 'cards_filters.card_id', 'cards.id')
                    ->where(['cards.id' => $card_row->id])
                    ->select("$table_name.*","cards.*", 'companies.alias as companies_alias', 'companies.reviews_page', 'cards_filters.filter')
                    ->first();
                return $card_;
            });
            //$card = $card_;

            $loadFrom = strpos($card->link_to_reviews_page, 'banks') ? 'banks' : 'companies';
            $card = ($loadFrom == 'banks')
                ? self::loadBankCard($card)
                : self::loadCompanyCard($card);
            $cards [] = $card;



        }
        return $cards;
    }








    // для карточек банков
    public static function loadBankCard($card)
    {

        $entityRow = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('cards.id','cards.category_id','banks.alias as bankAlias' ,'bank_products.alias as productAlias','bank_products.separate_page', 'cards_categories.bank_alias as categoryAlias', 'bank_category_pages.id as bankCategoryPagesID')
            ->where(['cards.id' => $card->id])
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->first();


        if ($entityRow == null) {
            return $card;
        }


        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_category_id' => $entityRow->bankCategoryPagesID])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();


        $card->ratingValue = BankReviews::getRatingByReviews($reviews);
        $card->ratingCount = count($reviews);


        return $card;
    }

    public static function loadCompanyCard($card)
    {
        if ($card->company_id != null || $card->company_id2 != null) {

            $company_id = ($card->company_id != null) ? $card->company_id : $card->company_id2;

            $rating = (new CompaniesReviewRepository)->getAvgAndCountReviewsByCompanyID($company_id);


            $card->ratingValue = $rating['ratingValue'];
            $card->ratingCount = $rating['ratingCount'];

        } else {
            $card->ratingValue = null;
            $card->ratingCount = null;
        }

        return $card;
    }


}