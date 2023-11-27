<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

/**
 * Post
 *
 * @mixin Eloquent
 * @property mixed $id
 * @property mixed $h1
 */
class Bank extends Model
{
    use SoftDeletes;

    protected $table = 'banks';

    protected $fillable = [
        'name',
        'full_name', // ---
        'alias',
        'logo',
        'og_img',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'lead',
        'content',
        'licence',  // !!--!!
        'bik',
        'account',
        'address_index',
        'city_id',
        'address',
        'okato',
        'date_opened',
        'swift',
        'site',
        'email', // ---
        'phone', // ---
        'ogrn', // ---
        'okpo',  // ---
        'inn', // !!--!!
        'kpp',  // !!--!!
        'leadership',
        'post_category_id',
        'show_credits',
        'show_auto_credits',
        'show_credit_cards',
        'show_debit_cards',
        'show_deposits',
        'show_mortgage',
        'show_refinancing',
        'show_rko',
        'show_cashback',
        'average_rating',
        'number_of_votes',
        'status',
    ];

}
