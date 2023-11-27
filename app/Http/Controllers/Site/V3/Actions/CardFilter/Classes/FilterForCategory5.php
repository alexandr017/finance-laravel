<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;
use DB;

class FilterForCategory5 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        $slf_limit_max = clear_data($data['slf_limit_max']);
        $slf_none_percent_period =  clear_data($data['slf_none_percent_period']);
        $slf_age = clear_data($data['slf_age']);
        $slf_percent_min =  clear_data($data['slf_percent_min']);

        $filters = clear_data($data['filters']);
        $filters = $filters ? explode(',', $filters) : null;
        $cardsToFilters = [];

        $banks = clear_data($data['banks']);
        $banks = $banks ? explode(',', $banks) : null;

        if ($filters) {
            $cardsToFilters = DB::table('cards_filters')
                ->select('card_id', 'filter')
                ->whereIn('card_id', array_column($cards, 'id'))
                ->get()
                ->groupBy('card_id')
                ->mapWithKeys(function ($item, $key) {
                    return [$key => $item->pluck('filter')];
                });
        }

        foreach ($cards as $key => $value) {
            if($slf_limit_max != ''){
                if($slf_limit_max > $value->limit_max) unset($cards[$key]);
            }
            if($slf_none_percent_period != ''){
                if($slf_none_percent_period > $value->none_percent_period) unset($cards[$key]);
            }
            if($slf_age != ''){
                if(($slf_age < $value->age_min) || ($slf_age > $value->age_max)) unset($cards[$key]);
            }
            if($slf_percent_min != ''){
                if(($slf_percent_min < $value->percent_min)) unset($cards[$key]);
            }

            if ($banks) {
                $cardHasBank = false;

                foreach ($banks as $bankId) {
                    if ($value->bank_id == $bankId) {
                        $cardHasBank = true;
                        break;
                    }
                }

                if (!$cardHasBank) {
                    unset($cards[$key]);
                }
            }

            if ($cardsToFilters) {
                if (!$cardsToFilters->get($value->id)) {
                    unset($cards[$key]);
                    continue;
                }

                foreach ($filters as $filterItem) {
                    if (!$cardsToFilters->get($value->id)->contains($filterItem)) {
                        unset($cards[$key]);
                        break;
                    }
                }
            }
        }

        return $cards;
    }
}