<?php

namespace App\Models\Cards;

use App\Models\BaseModel;

class CardsChildrenPagesLevel2 extends BaseModel
{
    protected $table = 'cards_children_pages_level_2';

    protected $fillable = [
        'parent_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'lead_block',
        'adv1',
        'adv2',
        'adv3',
        'total_compare_label',
        'status',
        'average_rating',
        'number_of_votes',
        'city_id'
    ];
}