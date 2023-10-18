<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Frontend\Actions\CardFilter\CardFilterInterface;

class FilterForCategory13 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        foreach ($cards as $key => $value) {
            $slf_summ =  clear_data($data['slf_summ']);
            $icons = clear_data($data['icons']);
            $icons = $icons ? explode(',', $icons) : null;

            if ($slf_summ != ''){
                if (($slf_summ < $value->sum_min) || ($slf_summ > $value->sum_max)) unset($cards[$key]);
            }
            if ($icons) {
                foreach ($icons as $icon) {
                    if (!$icon) continue;

                    if (!in_array($icon, explode(',', $value->icons))) unset($cards[$key]);
                }
            }
        }

        return $cards;
    }
}