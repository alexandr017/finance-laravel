<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Frontend\Actions\CardFilter\CardFilterInterface;
use DB;

class FilterForCategory4 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        $slf_summ = clear_data($data['slf_summ']);
        $slf_time =  clear_data($data['slf_time']);
        $slf_age = clear_data($data['slf_age']);

        $target = mb_strtolower(clear_data($data['target']));

        $filters = clear_data($data['filters']);
        $filters = $filters ? explode(',', $filters) : null;
        $cardsToFilters = [];

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

//        $income_verification = strtolower(clear_data($data['income_verification']));

        foreach ($cards as $key => $value) {
            if($slf_summ != ''){
                if(($slf_summ < $value->sum_min) || ($slf_summ > $value->sum_max)) unset($cards[$key]);
            }
            if($slf_time != ''){
                if(($slf_time < $value->term_min) || ($slf_time > $value->term_max)) unset($cards[$key]);
            }
            if($slf_age != ''){
                if(($slf_age < $value->age_min) || ($slf_age > $value->age_max)) unset($cards[$key]);
            }

            if($target){
                if(!str_contains(mb_strtolower($value->target), $target)) unset($cards[$key]);
            }

//            if ($income_verification != '') {
//                if(!str_contains(strtolower($value->income_verification), $income_verification)) unset($cards[$key]);
//            }

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