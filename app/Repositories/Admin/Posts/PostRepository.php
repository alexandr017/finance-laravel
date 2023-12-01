<?php

namespace App\Repositories\Admin\Posts;

use App\Repositories\Repository;
use App\Models\Posts\Posts as Model;

class PostRepository extends Repository
{
    /**
     * @return array
     */
    public function getForSelect() : array
    {
        $posts = Model::select('id','h1')
            ->get()
            ->pluck('h1','id')
            ->toArray();

        return array_merge([0 => 'Не выбрано'], $posts);
    }
    
    public function getForComments()
    {
        return Model::select('id', 'h1')
            ->pluck('h1', 'id')
            ->toArray();
    }
}
