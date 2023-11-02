<?php

namespace App\Repositories\Admin\Cards;

use App\Repositories\Repository;
use App\Models\Cards\CardsCategories as Model;
use App\Models\BaseModel;

class CardsCategoriesRepository extends Repository
{
    public function getForSelect()
    {
        $categories = Model::select('id','breadcrumb')->get();
        return BaseModel::convertToArray($categories,'breadcrumb',[null => 'Категория не выбрана']);
    }

    public function findById($id)
    {
        return Model::findOrFail($id);
    }

}
