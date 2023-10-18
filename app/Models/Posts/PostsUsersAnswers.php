<?php

namespace App\Models\Posts;

use App\Models\BaseModel;

class PostsUsersAnswers extends BaseModel
{
    protected $table = 'posts_users_answers';

    protected $fillable = [
        'post_id',
        'user_metrika_id',
        'find_answers'
    ];
}