<?php

namespace App\Repositories\Admin\Cards;

use App\Repositories\Repository;
use App\Models\Cards\ListingCards as Model;

class ListingCardsRepository extends Repository
{

    public function getForCheckboxes($id)
    {
        return Model::select('id','card_id')
            ->where(['listing_id' => $id])
            ->get()
            ->pluck('card_id','id')
            ->toArray();
    }


}
