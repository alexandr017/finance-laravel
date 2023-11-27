<?php

namespace App\Http\Requests\Admin\Cities;

use App\Repositories\Repository;
use App\Models\Cities\Cities as Model;

class CityRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getForSelect($add_empty_row = 'no_empty_row')
    {
        $result = Model::select('id','imenitelny')
            ->orderBy('imenitelny')
            ->get()
            ->pluck('imenitelny','id')
            ->toArray();

        if ($add_empty_row == 'with_empty_row') {
            $result = [0 => 'Город не выбран'] + $result;
        }

        return $result;
    }

    public function findOrFail($id){
        return Model::findOrFail($id);
    }

    public function getCities()
    {
        return Model::get();
    }

}
