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
        $IDWithDoubles = [];
        $cards = [];
        if ($categoryID == 1) {
            $cardsRow =  DB::table('cards')
                ->leftJoin('companies', 'companies.id', 'cards.company_id')
                ->select('cards.*')
                ->where(['cards.category_id' => $categoryID ,'cards.status' => 1, 'companies.status' => 1])
                ->orderBy('cards.flow')
                ->orderBy('cards.km5','desc')
                ->orderBy('cards.promo','desc')
                ->orderBy('cards.id')
                ->limit($limit * 2)
                ->get();

            foreach ($cardsRow as $row) {
                if (!isset($IDWithDoubles[$row->company_id])) {
                    $cards [] = $row;
                    $IDWithDoubles [$row->company_id] = 1;
                    if (count($cards) == $limit) {
                        break;
                    }
                }
            }
        } else {
            $cardsRow =  DB::table('cards')
                ->leftJoin('banks', 'banks.id', 'cards.bank_id')
                ->select('cards.*')
                ->where(['cards.category_id' => $categoryID ,'cards.status' => 1, 'banks.status' => 1])
                ->whereNull('banks.deleted_at')
                ->orderBy('cards.flow')
                ->orderBy('cards.km5','desc')
                ->orderBy('cards.promo','desc')
                ->orderBy('cards.id')
                ->limit($limit * 2)
                ->get();

            foreach ($cardsRow as $row) {
                if (!isset($IDWithDoubles[$row->bank_id])) {
                    $cards [] = $row;
                    $IDWithDoubles [$row->bank_id] = 1;
                    if (count($cards) == $limit) {
                        break;
                    }
                }
            }
        }

        return $cards;

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
            //->leftJoin('listing_cards','cards.id','listing_cards.card_id')
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
