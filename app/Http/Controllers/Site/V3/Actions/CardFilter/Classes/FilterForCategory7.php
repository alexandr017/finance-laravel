<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Frontend\Actions\CardFilter\CardFilterInterface;

class FilterForCategory7 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        $slf_summ =  clear_data($data['slf_summ']);
        $slf_time =  clear_data($data['slf_time']);
        $slf_percent =  clear_data($data['slf_percent']);
        $slf_age =  clear_data($data['slf_age']);

        foreach ($cards as $key => $value) {
            if($slf_summ != ''){
                if(($slf_summ < $value->sum_min) || ($slf_summ > $value->sum_max)) unset($cards[$key]);
            }
            if($slf_time != ''){
                if(($slf_time < $value->term_min) || ($slf_time > $value->term_max)) unset($cards[$key]);
            }
            if($slf_percent != ''){
                if($slf_percent <= $value->percent) unset($cards[$key]);

            }
            if($slf_age != ''){
                if(($slf_age < $value->age_min) || ($slf_age > $value->age_max)) unset($cards[$key]);
            }
        }

        return $cards;
    }
}