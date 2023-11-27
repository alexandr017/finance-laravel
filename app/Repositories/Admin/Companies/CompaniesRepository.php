<?php

namespace App\Repositories\Admin\Companies;

use App\Repositories\Repository;
use App\Models\Companies\Companies as Model;

class CompaniesRepository extends Repository
{
    public function getForShow()
    {
        return Model::get();
    }

    public function getForEdit($id)
    {
        return Model::findOrFail($id);
    }

    public function getForDelete($id)
    {
        return Model::findOrFail($id);
    }

    public function getForSelect($add_empty_row = 'no_empty_row'): array
    {
        $result = Model::select('id', 'h1')
            ->pluck('h1', 'id')
            ->toArray();

        if ($add_empty_row == 'with_empty_row') {
            $result = [0 => 'Не выбрано'] + $result;
        }

        return $result;
    }

    public function findById($companyId)
    {
        return Model::findOrFail($companyId);
    }
}
