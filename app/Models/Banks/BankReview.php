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
class BankReview extends Model
{
    use SoftDeletes;

    protected $table = 'bank_reviews';

    protected $fillable = [
        'parent_id',
        'author',
        'uid',
        'review',
        'rating',
        'pros',
        'minuses',
        'answer',
        'off_answer',
        'bank_id',
        'bank_category_id',
        'product_id',
        'status',
        'result'
    ];
}
