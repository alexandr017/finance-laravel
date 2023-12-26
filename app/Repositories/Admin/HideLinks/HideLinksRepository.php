<?php

namespace App\Repositories\Admin\HideLinks;

use App\Repositories\Repository;
use App\Models\HideLinks\HideLinks as Model;

class HideLinksRepository extends Repository
{
    private const ONLY_RESERVE_TYPE = 0;
    private const ALL_TYPE = 1;

    /**
     * @return mixed
     */
    public function getAllHideLinks()
    {
        return Model::select('id','in','out', 'clicks', 'redirect_type')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getOnlyReserveHideLinks()
    {
        return Model::select('id','in','out', 'clicks', 'redirect_type')
            ->where(['permission_type' => self::ONLY_RESERVE_TYPE])
            ->get();
    }

    public function checkPermissionForAdmin($linkID)
    {
        $row = Model::find($linkID);

        if ($row != null) {
           if ($row->permission_type == self::ONLY_RESERVE_TYPE) {
               return true;
           }
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForEdit($id)
    {
        return Model::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForEditOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
