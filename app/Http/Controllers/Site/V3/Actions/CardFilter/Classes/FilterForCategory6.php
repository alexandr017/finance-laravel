<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Frontend\Actions\CardFilter\CardFilterInterface;

class FilterForCategory6 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        $slf_opened =  clear_data($data['slf_opened']);
        $slf_maintenance = clear_data($data['slf_maintenance']);
        $slf_age =  clear_data($data['slf_age']);

        $banks = clear_data($data['banks']);
        $banks = $banks ? explode(',', $banks) : null;

        foreach ($cards as $key => $value) {
            if($slf_opened != ''){
                if ($slf_opened < $value->opened) unset($cards[$key]);
            }
            if($slf_maintenance != ''){
                if($slf_maintenance < $value->maintenance) unset($cards[$key]);
            }
            if($slf_age != ''){
                if(($slf_age < $value->age_min) ) unset($cards[$key]);
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
        }

        return $cards;
    }
}