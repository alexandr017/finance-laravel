<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use SoftDeletes;

    protected $table = 'translations';

    protected $fillable = [
        'alias',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'date_translation',
        'img',
        'og_img',
        'lead',
        'content',
        'average_rating',
        'number_of_votes',
        'status',
    ];

}
