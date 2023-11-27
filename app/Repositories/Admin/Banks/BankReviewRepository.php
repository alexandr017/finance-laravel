<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\BankReview as Model;
use DB;

class BankReviewRepository extends Repository
{
    public function getForShow($bankID = null, $categoryID = null)
    {
        if ($bankID == null && $categoryID == null) {
            $result = DB::table('bank_reviews')
                ->leftJoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_category_pages','bank_category_pages.id','bank_reviews.bank_category_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.id','bank_reviews.author', 'bank_reviews.status',
                    'banks.id as bankID', 'banks.name as bankName', 'banks.alias as bankAlias',
                    'bank_category_pages.id as bankCategoryID','bank_category_pages.h1 as bankCategoryH1',
                    'bank_products.product_name as productName'
                )
                ->whereNull('bank_reviews.deleted_at')
                ->get();
        } else {
            $result = DB::table('bank_reviews')
                ->leftJoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_category_pages','bank_category_pages.id','bank_reviews.bank_category_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.id','bank_reviews.author', 'bank_reviews.status',
                    'banks.id as bankID', 'banks.name as bankName', 'banks.alias as bankAlias',
                    'bank_category_pages.h1 as bankCategoryH1',
                    'bank_products.product_name as productName'
                )
                ->where(['bank_reviews.bank_id' =>$bankID, 'bank_reviews.bank_category_id' => $categoryID])
                ->whereNull('bank_reviews.deleted_at')
                ->get();
        }

        return $result;
    }

    public function getForShowPaginated($bankID = null, $categoryID = null, $sort = 'DESC', $items = 1000)
    {
        if ($bankID == null && $categoryID == null) {
            $result = DB::table('bank_reviews')
                ->leftJoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_category_pages','bank_category_pages.id','bank_reviews.bank_category_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.id','bank_reviews.author', 'bank_reviews.status',
                    'banks.id as bankID', 'banks.name as bankName', 'banks.alias as bankAlias',
                    'bank_category_pages.id as bankCategoryID','bank_category_pages.h1 as bankCategoryH1',
                    'bank_products.product_name as productName'
                )
                ->whereNull('bank_reviews.deleted_at')
                ->orderBy('id',$sort)
                ->paginate($items);
        } else {
            $result = DB::table('bank_reviews')
                ->leftJoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_category_pages','bank_category_pages.id','bank_reviews.bank_category_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.id','bank_reviews.author', 'bank_reviews.status',
                    'banks.id as bankID', 'banks.name as bankName', 'banks.alias as bankAlias',
                    'bank_category_pages.h1 as bankCategoryH1',
                    'bank_products.product_name as productName'
                )
                ->where(['bank_reviews.bank_id' =>$bankID, 'bank_reviews.bank_category_id' => $categoryID])
                ->whereNull('bank_reviews.deleted_at')
                ->orderBy('id', $sort)
                ->paginate($items);
        }

        return $result;
    }


    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
