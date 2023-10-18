<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class TranslationPostComment extends Model
{
    protected $table = 'translation_post_comments';

    protected $fillable = [
        'translation_post_id',
        'name',
        'comment',
        'status'
    ];

}