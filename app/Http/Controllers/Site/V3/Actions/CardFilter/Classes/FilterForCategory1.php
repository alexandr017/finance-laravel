<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;
use DB;

class FilterForCategory1 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        //ddd($data);
        $slf_summ =  clear_data($data['slf_summ']); // for quiz-new
        $slf_time =  clear_data($data['slf_time']); // for quiz-new

        $slf_summ_from = clear_data($data['slf_summ_from']);
        $slf_summ_from = $slf_summ_from ?: $slf_summ;
        $slf_summ_to = clear_data($data['slf_summ_to']);

        $slf_time_from = clear_data($data['slf_time_from']);
        $slf_time_from = $slf_time_from ?: $slf_time;
        $slf_time_to = clear_data($data['slf_time_to']);

        $slf_percent =  clear_data($data['slf_percent']);
        $slf_age =  clear_data($data['slf_age']);

        $filters = clear_data($data['filters']);
        $filters = $filters ? explode(',', $filters) : null;
        $cardsToFilters = [];

        $icons = clear_data($data['icons']);
        $icons = $icons ? explode(',', $icons) : null;
        
        $pay_method = mb_strtolower(clear_data($data['pay_method']));

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

            if($slf_summ_from != ''){
                if(($slf_summ_from < $value->sum_min) || ($slf_summ_from > $value->sum_max)) unset($cards[$key]);
            }

            if ($slf_summ_to != '') {
                if(($slf_summ_to < $value->sum_min) || ($slf_summ_to < $value->sum_max)) unset($cards[$key]);
            }

            if($slf_time_from != ''){
                if(($slf_time_from < $value->term_min) || ($slf_time_from > $value->term_max)) unset($cards[$key]);
            }

            if ($slf_time_to != '') {
                if(($slf_time_to < $value->term_min) || ($slf_time_to < $value->term_max)) unset($cards[$key]);
            }


            if($slf_percent != ''){
                if($slf_percent < $value->percent) unset($cards[$key]);

            }
            if($slf_age != ''){
                if(($slf_age < $value->age_min) || ($slf_age > $value->age_max)) unset($cards[$key]);
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
            if ($icons) {
                foreach ($icons as $icon) {
                    if (!$icon) continue;

                    if (!in_array($icon, explode(',', $value->icons))) unset($cards[$key]);
                }
            }

            if ($pay_method) {
                if(!str_contains(mb_strtolower($value->pay_method), $pay_method)) unset($cards[$key]);
            }
        }

        //ddd($cards);

//        if (\Auth::id() == 12467) {
//            dd($test);
//        }

        return $cards;
    }
}