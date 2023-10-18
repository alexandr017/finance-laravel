<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BankCategoryReviewsPage extends Model
{
    use SoftDeletes;

    protected $table = 'bank_category_reviews_pages';

    protected $fillable = [
        'bank_category_page_id',
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
