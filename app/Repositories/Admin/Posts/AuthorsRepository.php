<?php

namespace App\Repositories\Admin\Posts;

use App\Repositories\Repository;
use App\Models\Posts\Authors;

class AuthorsRepository extends Repository
{
    public function getForShow()
    {
        return Authors::all();
    }

    public function getForEdit($id)
    {
        return Authors::findOrFail($id);
    }

    public function getForDelete($id)
    {
        return Authors::findOrFail($id);
    }

    public function getForComments()
    {
        return Authors::pluck('name','id')
            ->toArray();
    }
}
