<?php

namespace App\Models\Posts;

use App\Models\BaseModel;

class PostsTag extends BaseModel
{
    protected $table = 'posts_tags';

    protected $fillable = [
        'tag',
        'category_id',
        'parent_id'
    ];
}