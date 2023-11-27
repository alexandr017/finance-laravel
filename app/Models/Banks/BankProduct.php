<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

/**
 * Post
 *
 * @mixin Eloquent
 */
class BankProduct extends Model
{
    use SoftDeletes;

    protected $table = 'bank_products';

    protected $fillable = [
        'bank_id',
        'bank_category_id',
        'product_name',
        'title',
        'meta_description',
        'h1',
        'alias',
        'breadcrumb',
        'is_cashback',
        'img',
        'img_og',
        'lead',
        'content',
        'scale_1',
        'scale_2',
        'scale_3',
        'scale_4',
        'scale_5',
        'closed',
        'average_rating',
        'number_of_votes',
        'separate_page',
        'status'
    ];

}
