<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\Bank as Model;

class BankRepository extends Repository
{
    const COUNT_ON_PAGE = 1000;

    public function getForShow()
    {
        return Model::select('id','name','h1','alias','status')
            ->whereNull('deleted_at')
            ->paginate(self::COUNT_ON_PAGE);
    }

    public function getForShowSocial()
    {
        return Model::select(
                [
                    'id',
                    'name',
                    'h1',
                    'link_vk',
                    'link_facebook',
                    'link_inst',
                    'link_youtube',
                    'link_ok',
                    'link_twitter',
                    'link_telegram',
                    'status'
                ]
            )
            ->whereNull('deleted_at')
            ->paginate(self::COUNT_ON_PAGE);
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

    public function getForSelect($add_empty_row = 'no_empty_row')
    {
        $result = Model::select('id','name')
            ->whereNull('deleted_at')
            ->pluck('name','id')
            ->toArray();

        if ($add_empty_row == 'with_empty_row') {
            $result = [0 => 'Банк не выбран'] + $result;
        }

        return $result;

    }

}
