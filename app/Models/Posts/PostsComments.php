<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostsComments extends Model
{
    protected $table = 'posts_comments';

    protected $fillable = [
        'pid',
        'author_name',
        'author_email',
        'uid',
        'comment',
        'parent',
        'status',
        'vzo_author'
    ];
}
