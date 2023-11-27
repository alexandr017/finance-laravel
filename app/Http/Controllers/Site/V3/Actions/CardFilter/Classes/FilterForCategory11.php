<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;
use DB;

class FilterForCategory11 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
       if (\Auth::id() == config('client-design.test-user-id') || config('client-design.mode') == 'production') {
            $slf_percent =  clear_data($data['slf_percent']);
            $slf_time =  clear_data($data['slf_time']);
            $slf_summ =  clear_data($data['slf_summ']);
            $replanishment =  clear_data($data['replanishment']);
            $partial_withdrawal =  clear_data($data['partial_withdrawal']);

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
                if($slf_percent != ''){
                    if(($slf_percent < $value->percent_min) || ($slf_percent > $value->percent_max)) unset($cards[$key]);
                }
                if($slf_time != ''){
                    if($slf_time > $value->term) unset($cards[$key]);
                }
                if($slf_summ != ''){
                    if(($slf_summ < $value->sum_min) || ($slf_summ > $value->sum_max)) unset($cards[$key]);
                }
                if ($replanishment) {
                    if (mb_strtolower($value->replanishment) != 'да' && mb_strtolower($value->replanishment) != 'есть') {
                        unset($cards[$key]);
                    }
                }
                if ($partial_withdrawal) {
                    if (mb_strtolower($value->partial_withdrawal) != 'да' && mb_strtolower($value->partial_withdrawal) != 'есть') {
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
        }

        return $cards;
    }
}