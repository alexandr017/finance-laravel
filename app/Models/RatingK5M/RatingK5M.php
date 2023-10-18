<?php

namespace App\Models\RatingK5M;

use App\Models\BaseModel;

class RatingK5M extends BaseModel
{
    protected $table = 'rating_k5m';

    protected $fillable = [
        'category_id',
        'month',
        'year',
        'k5m'
    ];
}