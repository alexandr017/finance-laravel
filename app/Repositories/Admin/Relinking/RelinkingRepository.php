<?php

namespace App\Repositories\Admin\Relinking;

use App\Repositories\Repository;
use App\Models\Relinking\Relinking as Model;
use DB;

class RelinkingRepository extends Repository
{

    public function getForShow()
    {
        return Model::join('relinking_groups', 'relinking_groups.id', 'relinking.relinking_group_id')
            ->select('relinking_groups.group_name as group_name', 'relinking.*')
            ->get();
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
