<?php

namespace App\Repositories\Admin\Relinking;

use App\Repositories\Repository;
use App\Models\Relinking\RelinkingGroup as Model;
use DB;

class RelinkingGroupRepository extends Repository
{

    public function getForShow()
    {
        return Model::join('cards_categories', 'cards_categories.id', 'relinking_groups.category_id')
            ->select('cards_categories.breadcrumb as category_name', 'relinking_groups.*')
            ->get();
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
