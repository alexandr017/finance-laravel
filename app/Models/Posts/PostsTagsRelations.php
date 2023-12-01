<?php

namespace App\Models\Posts;

use App\Models\BaseModel;

class PostsTagsRelations extends BaseModel
{
    protected $table = 'posts_tags_relation';

    protected $fillable = [
        'post_id',
        'tag_id'
    ];

    public $timestamps = false;

}