<?php

namespace App\Repositories\Admin\Posts;

use App\Repositories\Repository;
use App\Models\Posts\PostsCategories as Model;

class PostCategoryRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getForSelect($add_empty_row = 'no_empty_row')
    {
        $result = Model::select('id','h1')
            ->get()
            ->pluck('h1','id')
            ->toArray();


        if ($add_empty_row == 'with_empty_row') {
            $result = [0 => 'Категория не выбрана'] + $result;
        }


        return $result;

    }

    public function findOrFail($id){
        return Model::findOrFail($id);
    }

}
