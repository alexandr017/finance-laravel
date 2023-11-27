<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter;

interface CardFilterInterface
{
    public function filter($cards, $data);
}