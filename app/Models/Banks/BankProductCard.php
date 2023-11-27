<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * Post
 *
 * @mixin Eloquent
 */
class BankProductCard extends Model
{

    protected $table = 'bank_product_cards';

    protected $fillable = [
        'bank_product_id',
        'card_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'id' => 'integer',
        'bank_product_id' => 'integer',
        'card_id' => 'integer',
    ];
}
