<?php

namespace App\Models\Relinking;

use Illuminate\Database\Eloquent\Model;

class Relinking extends Model
{
    protected $table = 'relinking';

    protected $fillable = [
        'category_id',
        'title',
        'link',
        'relinking_group_id',
        'sort_order',
        'listing_type',
        'listing_id'
    ];

    public $timestamps = false;
}
