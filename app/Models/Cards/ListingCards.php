<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class ListingCards extends Model
{

    protected $table = 'listing_cards';

    protected $fillable = [
        'listing_id',
        'card_id',
    ];

    public $timestamps = false;

}