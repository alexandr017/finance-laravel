<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\BankProduct as Model;
use DB;

class BankProductRepository extends Repository
{
    public function getForShow($bankID = null, $categoryID = null)
    {
        // продукты
        // банки
        // каетгории карточек

        // категории продуктов


        // /{card_category.alias_for_bank}
        if ($bankID == null && $categoryID == null) {
            $result = DB::table('bank_products')
                ->leftJoin('banks','banks.id','bank_products.bank_id')
                ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
                ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
                ->select('bank_products.id','bank_products.bank_category_id','bank_products.product_name', 'bank_products.alias', 'bank_products.status',
                    'banks.id as bankID', 'banks.name as bankName', 'banks.alias as bankAlias',
                    'cards_categories.bank_alias as bankCategoryAlias'
                )
                ->whereNull('bank_products.deleted_at')
                ->get();
        } else {
            $result = DB::table('bank_products')
                ->leftJoin('banks','banks.id','bank_products.bank_id')
                ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
                ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
                ->select('bank_products.id','bank_products.bank_category_id','bank_products.product_name', 'bank_products.alias', 'bank_products.status',
                    'banks.id as bankID', 'banks.name as bankName', 'banks.alias as bankAlias',
                    'cards_categories.bank_alias as bankCategoryAlias'
                )
                ->where(['bank_products.bank_id' =>$bankID, 'bank_products.bank_category_id' => $categoryID])
                ->whereNull('bank_products.deleted_at')
                ->get();
        }


        return $result;
    }

    public function getForSelect($bankID = null, $categoryId = null, $add_empty_row = 'no_empty_row')
    {
        if ($bankID == null && $categoryId == null) {
            $items = DB::table('bank_products')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->pluck('h1','id')
                ->toArray();

        } elseif($bankID == null && $categoryId != null) {
            $items = DB::table('bank_products')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->where(['bank_id' => $bankID])
                ->pluck('h1','id')
                ->toArray();
        } else {
            $items = DB::table('bank_products')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->where(['bank_id' => $bankID, 'category_id' => $categoryId])
                ->pluck('h1','id')
                ->toArray();
        }

        if ($add_empty_row == 'with_empty_row') {
            $items = [0 => 'Продукт не выбран'] + $items;
        }


        return $items;
    }


    public function getForSelectReviews($bankID, $categoryID = null, $add_empty_row = 'no_empty_row')
    {
        if ($categoryID == null) {
            $items = DB::table('bank_products')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->where(['bank_id' => $bankID])
                ->get();
        } else {
            $items = DB::table('bank_products')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->where(['bank_id' => $bankID, 'bank_category_id' => $categoryID])
                ->get();
        }

        if ($add_empty_row == 'with_empty_row') {
            $items = [0 => 'Продукт не выбран'] + $items;
        }


        return $items;
    }



    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
