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
class BankCategoryPage extends Model
{
    use SoftDeletes;

    protected $table = 'bank_category_pages';

    protected $fillable = [
        'bank_id',
        'category_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'lead',
        'scale_1',
        'scale_2',
        'scale_3',
        'scale_4',
        'scale_5',
        'content',
        'average_rating',
        'number_of_votes',
        'status'
    ];

}
