<?php

namespace App\Repositories\Admin\AffiliateProgram;

use App\Repositories\Repository;
use App\Models\AffiliateProgram\AffiliateProgram as Model;

class AffiliateProgramRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getForShow()
    {
        return Model::select('id','name')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForEditOrFail($id)
    {
        return Model::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function getAffiliatePrograms()
    {
        $items = Model::select('id','name')->get();

        return Model::convertToArray($items,'name', [null => 'Выберите пункт']);

    }

    /**
     * @return mixed
     */
    public function getAffiliateProgramsNoNull()
    {
        $items = Model::select('id','name')->get();

        return Model::convertToArray($items,'name');

    }

}
