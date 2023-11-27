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
class BankProductReviewsPage extends Model
{
    use SoftDeletes;

    protected $table = 'bank_product_reviews_pages';

    protected $fillable = [
        'bank_product_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'content',
        'average_rating',
        'number_of_votes',
        'status'
    ];

}