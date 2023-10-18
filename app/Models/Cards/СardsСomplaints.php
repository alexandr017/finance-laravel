<?php

namespace App\Models\Cards;

use App\Models\BaseModel;

class СardsСomplaints extends BaseModel
{
    protected $table = 'cards_complaints';

    protected $fillable = [
        'card_id',
        'metrika_id',
        'cards_complaints_types_id',
        'message',
        'status'
    ];
}