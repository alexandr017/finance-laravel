<?php

namespace App\Repositories\Admin\Cards;

use App\Repositories\Repository;
use App\Models\Cards\Cards as Model;
use App\Models\Cards\Listing;
use App\Models\BaseModel;
use DB;

class CardsRepository extends Repository
{

    /**
     * @return mixed
     */
    public function getForSelect()
    {
        $items = Model::select('id','title')->get();
        return BaseModel::convertToArray($items,'title');
    }

    public function getForCheckboxByCategories($id)
    {
        $listing = Listing::find($id);

        if (is_null($listing)) {
            return [];
        }

        $category = DB::table('cards_categories')->where(['id' => $listing->category_id])->first();

        $IDs = explode(',', $category->card_categories);

        return Model::select('id','title')
            ->whereIn('category_id', $IDs)
            ->get()
            ->pluck('title','id')
            ->toArray();
    }


}
