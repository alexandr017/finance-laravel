<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\BankInfoPage as Model;
use DB;

class BankInfoPageRepository extends Repository
{
    public function getForShow($bankID = null)
    {
        if ($bankID == null) {
            $result = DB::table('bank_info_pages')
                ->leftJoin('banks','bank_info_pages.bank_id','banks.id')
                ->leftJoin('companies_children_page_types','bank_info_pages.type_id','companies_children_page_types.id')
                ->select('bank_info_pages.id','bank_info_pages.type_id','bank_info_pages.h1','bank_info_pages.status'
                    ,'companies_children_page_types.alias as pageAlias',
                    'banks.id as bankID', 'banks.alias as bankAlias')
                ->whereNull('bank_info_pages.deleted_at')
                ->get();
        } else {
            $result = DB::table('bank_info_pages')
                ->leftJoin('banks','bank_info_pages.bank_id','banks.id')
                ->leftJoin('companies_children_page_types','bank_info_pages.type_id','companies_children_page_types.id')
                ->select('bank_info_pages.id','bank_info_pages.type_id','bank_info_pages.h1','bank_info_pages.status'
                    ,'companies_children_page_types.alias as pageAlias',
                    'banks.id as bankID', 'banks.alias as bankAlias')
                ->where(['bank_info_pages.bank_id' =>$bankID])
                ->whereNull('bank_info_pages.deleted_at')
                ->get();
        }


        return $result;
    }

    public function getFreeTypePages($bankID)
    {
        $typePages = DB::table('companies_children_page_types')
            ->select('id','type')
            ->get()
            ->pluck('type','id');


        $bankPages = Model::select('id','type_id')
            ->where(['bank_id' =>$bankID])
            ->whereNull('deleted_at')
            ->get()
            ->pluck('id','type_id');

        foreach ($typePages as $typeKey => $typePage) {
            if (isset($bankPages[$typeKey])) {
                unset($typePages[$typeKey]);
            }
        }

        return $typePages;
    }


    public function getFreeTypePagesWithCurrent($bankID, $typeID)
    {
        $typePages = DB::table('companies_children_page_types')
            ->select('id','type')
            ->get()
            ->pluck('type','id');


        $bankPages = Model::select('id','type_id')
            ->where(['bank_id' =>$bankID])
            ->whereNull('deleted_at')
            ->get()
            ->pluck('id','type_id');

        foreach ($typePages as $typeKey => $typePage) {
            $removeElement = isset($bankPages[$typeKey]) && $typeKey != $typeID;
            if ($removeElement) {
                unset($typePages[$typeKey]);
            }
        }

        return $typePages;
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
