<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter\Classes;

use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilterInterface;

class FilterForCategory12 implements CardFilterInterface
{
    public function filter($cards, $data)
    {
        // terminal_rental
        $has_terminal_rental =  clear_data($data['has_terminal_rental']);

        foreach ($cards as $key => $value) {
            if ($has_terminal_rental) {
                if (!$value->terminal_rental) unset($cards[$key]);
            }
        }

        return $cards;
    }
}