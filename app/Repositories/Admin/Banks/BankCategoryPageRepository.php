<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\BankCategoryPage as Model;
use DB;

class BankCategoryPageRepository extends Repository
{
    public function getForShow($bankID = null)
    {
        if ($bankID == null) {
            $result = DB::table('bank_category_pages')
                ->leftJoin('banks','bank_category_pages.bank_id','banks.id')
                ->leftjoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
                ->select('bank_category_pages.id', 'bank_category_pages.category_id','bank_category_pages.h1','bank_category_pages.status',
                    'banks.id as bankID', 'banks.alias as bankAlias',
                    'cards_categories.bank_alias as categoryAlias')
                ->whereNull('bank_category_pages.deleted_at')
                ->get();
        } else {
            $result = DB::table('bank_category_pages')
                ->leftJoin('banks','bank_category_pages.bank_id','banks.id')
                ->leftjoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
                ->select('bank_category_pages.id', 'bank_category_pages.category_id','bank_category_pages.h1','bank_category_pages.status',
                    'banks.id as bankID', 'banks.alias as bankAlias',
                    'cards_categories.bank_alias as categoryAlias')
                ->where(['bank_category_pages.bank_id' =>$bankID])
                ->whereNull('bank_category_pages.deleted_at')
                ->get();
        }

        return $result;
    }

    public function getFreeTypePages($bankID)
    {
        return DB::table('cards_categories')
            ->select('id','breadcrumb')
            ->get()
            ->pluck('breadcrumb','id');
    }


    public function getFreeTypePagesWithCurrent($bankID, $typeID)
    {
        $categoryPages = DB::table('cards_categories')
            ->select('id','breadcrumb')
            ->get()
            ->pluck('breadcrumb','id');


        $bankPages = Model::select('id','category_id')
            ->where(['bank_id' =>$bankID])
            ->whereNull('deleted_at')
            ->get()
            ->pluck('id','category_id');

        foreach ($categoryPages as $typeKey => $categoryPage) {
            $removeElement = isset($bankPages[$typeKey]) && $typeKey != $typeID;
            if ($removeElement) {
                //unset($categoryPages[$typeKey]);
            }
        }

        return $categoryPages;
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

    public function getForSelect($bankID = null)
    {
        if ($bankID == null) {
            $items = DB::table('bank_category_pages')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->get()
                ->pluck('h1','id');

        } else {
            $items = DB::table('bank_category_pages')
                ->select('id','h1')
                ->whereNull('deleted_at')
                ->where(['bank_id' => $bankID])
                ->get()
                ->pluck('h1','id');
        }

        return $items;
    }

}
