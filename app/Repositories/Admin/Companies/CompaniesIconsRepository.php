<?php

namespace App\Repositories\Admin\Companies;

use App\Repositories\Repository;
use App\Models\Companies\CompaniesIcons as Model;

class CompaniesIconsRepository extends Repository
{
    public function getForSelect(): array
    {
        return Model::select(['companies_icons.*', 'cards_categories.breadcrumb as category_name'])
            ->leftJoin('cards_categories', 'companies_icons.category_id', 'cards_categories.id')
            ->get()
            ->groupBy('category_name')
            ->toArray();
    }
}
