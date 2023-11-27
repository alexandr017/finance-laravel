<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;

class FilterForCategory2 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        $slf_opened = clear_data($data['slf_opened']);
        $slf_maintenance =  clear_data($data['slf_maintenance']);
        $slf_count_payment =  clear_data($data['slf_count_payment']);

        $slf_summ =  clear_data($data['slf_summ']);
        if ($slf_summ) {
            $slf_count_payment = $slf_summ;
        }

        foreach ($cards as $key => $value) {
            if($slf_opened != ''){
                if ($slf_opened < $value->opened) unset($cards[$key]);
            }
            if($slf_maintenance != ''){
                if($slf_maintenance < $value->maintenance) unset($cards[$key]);
            }
            if($slf_count_payment != ''){
                if($slf_count_payment < $value->count_payment) unset($cards[$key]);
            }
        }

        return $cards;
    }
}