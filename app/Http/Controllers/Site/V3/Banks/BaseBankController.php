<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class BaseBankController extends Controller
{
    public function __construct()
    {

    }

    protected function arrMerge(array $array1, Collection $array2) : array
    {
        foreach ($array1 as $key => $item) {
            if (isset($array2[$key])) {
                $item->productAlias = $array2[$key]->productAlias;
                $item->bankAlias = $array2[$key]->bankAlias;
                $item->separate_page = $array2[$key]->separate_page;
            }
        }

        return $array1;
    }
}
