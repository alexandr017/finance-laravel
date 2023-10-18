<?php

namespace App\Repositories\Frontend\Card;

use App\Repositories\Repository;
use App\Models\Cards\Cards as Model;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Cards\CardSorting;
use App\Models\Cards\CardsCategories;
use GlobalAlgorithms;

class CardRepository extends Repository
{

    public function getSortedCards($listing_id, $sort_field = 'km5', $sort_type = 'desc')
    {

        // получения списка карточек (id и category_id)

        $flow1_IDs = $this->getListEnableCardsFromNewListingByFlow($listing_id, 1);
        $flow2_IDs = $this->getListEnableCardsFromNewListingByFlow($listing_id, 2);
        $flow3_IDs = $this->getListEnableCardsFromNewListingByFlow($listing_id, 3);


        // получение карточек
        $cards1 = CardsBoot::getCardsForListingByIDs($flow1_IDs);
        $cards2 = CardsBoot::getCardsForListingByIDs($flow2_IDs);
        $cards3 = CardsBoot::getCardsForListingByIDs($flow3_IDs);


        if ($sort_field == 'cache_back') {
            foreach ($cards1 as $key => $value) {
                $cards1[$key]->_cache_back = (float) GlobalAlgorithms::getMaxNumberWithPercentFromStr($value->cache_back);
            }
            foreach ($cards2 as $key => $value) {
                $cards2[$key]->_cache_back = (float) GlobalAlgorithms::getMaxNumberWithPercentFromStr($value->cache_back);
            }
            foreach ($cards3 as $key => $value) {
                $cards3[$key]->_cache_back = (float) GlobalAlgorithms::getMaxNumberWithPercentFromStr($value->cache_back);
            }
            $sort_field = '_cache_back';
            //ddd($cards1);
        }


        // сортировка
        $cards1 = CardSorting::sort($cards1, $sort_field, $sort_type);
        $cards2 = CardSorting::sort($cards2, $sort_field, $sort_type);
        $cards3 = CardSorting::sort($cards3, $sort_field, $sort_type);



        $cards = array_merge($cards1, array_merge($cards2, $cards3));


        return $cards;
    }


    public function getListEnableCardsFromOldListingByFlow($listing_id, $flow)
    {
        $currentDate = date('d-m-Y');

        if ($listing_id > 0) {

            $items = DB::table('cards')
                ->leftJoin('cards_childrens','cards.id','cards_childrens.card_id')
                ->select('cards.id','cards.category_id')
                ->where([
                    'cards_childrens.children_id' => $listing_id,
                    'cards.status' => 1,
                    'cards.flow' => $flow
                ])
                ->where(function ($query) use ($currentDate) {
                    $query->where('cards.days_off', 'NOT LIKE', "%$currentDate%")
                        ->orWhereNull('cards.days_off');
                })
                ->get();

        } else {

            $items = DB::table('cards')
                ->select('cards.id','cards.category_id')
                ->where([
                    'cards.category_id' => abs($listing_id),
                    'cards.status' => 1,
                    'cards.flow' => $flow
                ])
                ->where(function ($query) use ($currentDate) {
                    $query->where('cards.days_off', 'NOT LIKE', "%$currentDate%")
                        ->orWhereNull('cards.days_off');
                })
                ->get();

            if (!count($items)) {
                $items = $this->getListEnableCardsFromNewListingByFlow($listing_id, $flow);
            }
        }

        return $items;
    }

    public function getListEnableCardsFromNewListingByFlow($listing_id, $flow)
    {
        $currentDate = date('d-m-Y');

        $items = DB::table('cards')
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


        return $items;
    }


    public function getListEnableCardsFromIndexPage($flow)
    {
        $currentDate = date('d-m-Y');

        $const_category_id = 1;

        $items = DB::table('cards')
            ->select('cards.id','cards.category_id')
            ->where([
                'cards.category_id' => $const_category_id,
                'cards.status' => 1,
                //'cards.show_in_index' => 1,
                //'cards.flow' => $flow
            ])
            ->where(function ($query) use ($currentDate) {
                $query->where('cards.days_off', 'NOT LIKE', "%$currentDate%")
                 ->orWhereNull('cards.days_off');
            })
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.id", 'asc')
            ->get();

        return $items;
    }


}
