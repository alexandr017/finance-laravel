<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostsCategories extends Model
{
    protected $table = 'posts_categories';

    protected $fillable = ['title', 'alias_category', 'h1', 'breadcrumbs', 'text', 'meta_description',
        'show_date_publish_in_posts', 'show_author_in_posts', 'show_comments_in_posts',
        'sidebar_menu', 'sidebar_order', 'short_name', 'icon'];
}
