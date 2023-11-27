<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;
use DB;

class FilterForCategory10 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        /*
        $slf_summ =  clear_data($data['slf_summ']);
        $slf_time =  clear_data($data['slf_time']);
        $slf_age =  clear_data($data['slf_age']);

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
        }
        */
        if (\Auth::id() == config('client-design.test-user-id') || config('client-design.mode') == 'production') {
            $slf_summ =  clear_data($data['slf_summ']);
            $slf_time =  clear_data($data['slf_time']);
            $an_initial_fee = clear_data($data['an_initial_fee']);
            $interest_rate = clear_data($data['interest_rate']);
            $income_verification = mb_strtolower(clear_data($data['income_verification']));

            $property_type = clear_data($data['property_type']);
            $property_type = $property_type ? explode('/', $property_type) : null;

            $mortgage_program = clear_data($data['mortgage_program']);
            $mortgage_program = $mortgage_program ? explode(',', $mortgage_program) : null;

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

            foreach ($cards as $key => $value) {
                if($slf_summ){
                    if(($slf_summ < $value->sum_min) || ($slf_summ > $value->sum_max)) unset($cards[$key]);
                }
                if($slf_time){
                    if(($slf_time < $value->term_min) || ($slf_time > $value->term_max)) unset($cards[$key]);
                }

                if($an_initial_fee != ''){
                    if(($an_initial_fee < $value->an_initial_fee_min) || ($value->an_initial_fee_max && $an_initial_fee > $value->an_initial_fee_max)) unset($cards[$key]);
                }

                if($interest_rate != ''){
                    if(($interest_rate < $value->percent_min) || ($value->percent_max && $interest_rate > $value->percent_max)) unset($cards[$key]);
                }

                if ($income_verification) {
                    if(!str_contains(mb_strtolower($value->income_verification), $income_verification)) unset($cards[$key]);
                }

                if ($property_type) {
                    $hasPropertyType = false;

                    foreach ($property_type as $item) {
                        $hasPropertyType = str_contains(mb_strtolower($value->property_type), mb_strtolower($item));

                        if ($hasPropertyType) {
                            break;
                        }
                    }

                    if (!$hasPropertyType) {
                        unset($cards[$key]);
                    }
                }

                if ($mortgage_program) {
                    foreach ($mortgage_program as $item) {
                        if (!str_contains(mb_strtolower($value->mortgage_program), mb_strtolower($item))) {
                            unset($cards[$key]);
                        }
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
        }

        return $cards;
    }
}