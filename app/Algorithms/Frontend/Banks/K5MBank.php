<?php

namespace App\Algorithms\Frontend\Banks;

use DB;

class K5MBank {

    public static function getRatingByBankID($id)
    {
        $row = DB::table('bank_products')
            ->leftjoin('bank_product_cards','bank_product_cards.bank_product_id','bank_products.id')
            ->leftjoin('cards','cards.id', 'bank_product_cards.card_id')
            ->select(DB::raw('avg( cards.km5 ) as avgK5M'))
            ->where(['bank_products.status' => 1, 'bank_products.bank_id' => $id])
            ->whereNull('bank_products.deleted_at')
            ->first();

        if ($row->avgK5M == 0) {
            return null;
        }

        if ($row->avgK5M % 10 == 0) {
            return round($row->avgK5M);
        }

        return round($row->avgK5M, 1);
    }

    public static function getRatingByBankCategoryID($categoryID)
    {
        $row = DB::table('bank_products')
            ->leftjoin('bank_product_cards','bank_product_cards.bank_product_id','bank_products.id')
            ->leftjoin('cards','cards.id', 'bank_product_cards.card_id')
            ->select('bank_products.product_name',DB::raw('avg( cards.km5 ) as avgK5M'))
            ->where(['bank_products.status' => 1, 'bank_products.bank_category_id' => $categoryID])
            ->whereNull('bank_products.deleted_at')
            ->first();


        if ($row->avgK5M == 0) {
            return null;
        }

        if ($row->avgK5M % 10 == 0) {
            return round($row->avgK5M);
        }

        return round($row->avgK5M, 1);
    }
}