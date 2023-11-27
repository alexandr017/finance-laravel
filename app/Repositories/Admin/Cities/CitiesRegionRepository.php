<?php

namespace App\Repositories\Admin\Cities;

use App\Repositories\Repository;
use App\Models\Cities\Regions as Model;

class CitiesRegionRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getForSelect()
    {
        return Model::select('id','region')
            ->get()
            ->pluck('region','id')
            ->toArray();
    }

    public function findOrFail($id){
        return Model::findOrFail($id);
    }

}
