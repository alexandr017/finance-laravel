<?php

namespace App\Http\Controllers\Frontend\Actions\CardFilter;

interface CardFilterInterface
{
    public function filter($cards, $data);
}