<?php

namespace App\Repositories\Admin\Companies;

use App\Repositories\Repository;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Companies\CompaniesChildrenPagesTypes;

class CompanyChildrenPagesRepository extends Repository
{
    public function getForShow($companyId = null)
    {
        return CompaniesChildrenPages::select('companies_children_pages.*', 'companies_children_page_types.type')
            ->where('company_id', $companyId)
            ->leftJoin(
                'companies_children_page_types',
                'companies_children_pages.type_id',
                'companies_children_page_types.id'
            )
            ->orderBy('companies_children_pages.id','desc')
            ->get();
    }

    public function getForEdit($id)
    {
        return CompaniesChildrenPages::findOrFail($id);
    }

    public function getForDelete($id)
    {
        return CompaniesChildrenPages::findOrFail($id);
    }

    public function getTypesForSelect($companyId = null)
    {
         $childrenWithTypes = CompaniesChildrenPages::select('type_id')
             ->where('company_id', $companyId)
             ->pluck('type_id')
             ->toArray();

        return CompaniesChildrenPagesTypes::select('id', 'type')
            ->when($companyId, function ($query) use ($childrenWithTypes) {
                return $query->whereNotIn('id', $childrenWithTypes);
            })
            ->pluck('type', 'id')
            ->toArray();
    }

    public function getTypeAlias($typeId)
    {
        return CompaniesChildrenPagesTypes::where('id', $typeId)
            ->value('alias');
    }
}
