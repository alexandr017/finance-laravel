<?php

namespace App\Repositories\Site\Card;

use App\Repositories\Repository;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Cards\CardSorting;

class CardRepository extends Repository
{

    public function getSortedCards($listing_id, $sort_field = 'km5', $sort_type = 'desc')
    {
        // получения списка карточек (id и category_id)
        $flow1_IDs = $this->getListEnableCardsFromListingByFlow($listing_id, 1);
        $flow2_IDs = $this->getListEnableCardsFromListingByFlow($listing_id, 2);
        $flow3_IDs = $this->getListEnableCardsFromListingByFlow($listing_id, 3);

        // получение карточек
        $cards1 = CardsBoot::getCardsForListingByIDs($flow1_IDs);
        $cards2 = CardsBoot::getCardsForListingByIDs($flow2_IDs);
        $cards3 = CardsBoot::getCardsForListingByIDs($flow3_IDs);

        // сортировка
        $cards1 = CardSorting::sort($cards1, $sort_field, $sort_type);
        $cards2 = CardSorting::sort($cards2, $sort_field, $sort_type);
        $cards3 = CardSorting::sort($cards3, $sort_field, $sort_type);

        return  array_merge($cards1, array_merge($cards2, $cards3));
    }

    public function getProductForIndex(int $categoryID, int $limit = 3)
    {
        return DB::table('cards')
            ->where(['category_id' => $categoryID ,'status' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('promo','desc')
            ->orderBy('id')
            ->limit($limit)
            ->get();
    }

    public function getProductForSection(int $categoryID, $sort_field = 'km5', $sort_type = 'desc')
    {
        // получения списка карточек (id и category_id)
        $flow1_IDs = $this->getListEnableCardsFromSectionByFlow($categoryID, 1);
        $flow2_IDs = $this->getListEnableCardsFromSectionByFlow($categoryID, 2);
        $flow3_IDs = $this->getListEnableCardsFromSectionByFlow($categoryID, 3);

        // получение карточек
        $cards1 = CardsBoot::getCardsForListingByIDs($flow1_IDs);
        $cards2 = CardsBoot::getCardsForListingByIDs($flow2_IDs);
        $cards3 = CardsBoot::getCardsForListingByIDs($flow3_IDs);

        // сортировка
        $cards1 = CardSorting::sort($cards1, $sort_field, $sort_type);
        $cards2 = CardSorting::sort($cards2, $sort_field, $sort_type);
        $cards3 = CardSorting::sort($cards3, $sort_field, $sort_type);

        return  array_merge($cards1, array_merge($cards2, $cards3));
    }


    private function getListEnableCardsFromListingByFlow($listing_id, $flow)
    {
        $currentDate = date('d-m-Y');

        return DB::table('cards')
            ->leftJoin('listing_cards','cards.id','listing_cards.card_id')
            ->select('cards.id','cards.category_id')
            ->where([
                'listing_cards.listing_id' => $listing_id,
                'cards.status' => 1,
                'cards.flow' => $flow
            ])
            ->where(function ($query) use ($currentDate) {
                $query->where('cards.days_off', 'NOT LIKE', "%$currentDate%")
                    ->orWhereNull('cards.days_off');
            })
            ->get();
    }

    private function getListEnableCardsFromSectionByFlow($sectionID, $flow)
    {
        $currentDate = date('d-m-Y');

        return DB::table('cards')
            ->leftJoin('listing_cards','cards.id','listing_cards.card_id')
            ->select('cards.id','cards.category_id')
            ->where([
                'cards.category_id' => $sectionID,
                'cards.status' => 1,
                'cards.flow' => $flow
            ])
            ->where(function ($query) use ($currentDate) {
                $query->where('cards.days_off', 'NOT LIKE', "%$currentDate%")
                    ->orWhereNull('cards.days_off');
            })
            ->get();
    }
}
