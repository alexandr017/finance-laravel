<?php

namespace App\Repositories\Site\Bank;

use App\Models\Banks\Bank;
use DB;
use Illuminate\Support\Collection;

class BankRepository
{
    public function getBankByAlias(string $bankAlias) : ?Bank
    {
        return Bank::where(['alias' => $bankAlias, 'status' => 1, 'deleted_at' => null])->first();
    }

    public function getTopProductByCategory(int $categoryID, int $bankID = null, $limit = 3) : Collection
    {
        $where = ['cards.category_id' => $categoryID, 'banks.status' =>1];

        if ($bankID != null) {
            $where ['bank_id'] = $bankID;
        }

        return DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.category_id','bank_products.alias as productAlias','bank_products.separate_page', 'banks.alias as bankAlias')
            ->where($where)
            ->whereNull('bank_products.deleted_at')
            ->orderBy("cards.flow")
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id")
            ->limit($limit)
            ->get();
    }
}