<?php

namespace App\Repositories\Frontend\Insurance;

use App\Repositories\Repository;
use App\Models\Insurance\InsuranceTagsGroups as Model;
use Cache;

class InsuranceRepository extends Repository
{

    /**
     * @return mixed
     */
    public function getGroupsForCategory($id)
    {
        $items = Cache::rememberForever('insurance_tags_groups_'.$id,  function() use($id)  {
            return Model::where(['category_id' => $id])->get();
        });


        return $items;
    }



}
