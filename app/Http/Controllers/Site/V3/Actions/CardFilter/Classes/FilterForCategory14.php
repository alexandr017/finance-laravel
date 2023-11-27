<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;

class FilterForCategory14 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        $free_open = clear_data($data['free_open']);

        foreach ($cards as $key => $value) {
            if ($free_open) {
                if ($value->opened != 0) unset($cards[$key]);
            }
        }

        return $cards;
    }
}