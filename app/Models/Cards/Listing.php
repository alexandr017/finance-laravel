<?php

namespace App\Models\Cards;

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
class Listing extends Model
{
    use SoftDeletes;

    protected $table = 'listings';

    protected $fillable = [
        'id',
        'category_id',
        'parent_id',
        'parent_table',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'expert_anchor',
        'h2',
        'img',
        'infographic',
        'lead',
        'content',
        'total_compare_label',
        'city_id',
        'number_in_exel',
        'average_rating',
        'number_of_votes',
        'status',
        'alias'
    ];
}