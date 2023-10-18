<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TranslationPost extends Model
{
    use SoftDeletes;

    protected $table = 'translation_posts';

    protected $fillable = [
        'translation_id',
        'title',
        'content',
        'date',
        'status'
    ];

}
