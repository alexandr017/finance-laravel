<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'alias',
        'h1',
        'h1_in_category',
        'breadcrumb',
        'expert_anchor',
        'lead',
        'infographic',
        'pcid',
        'short_content',
        'date_upd',
        'content',
        'thumbnail',
        'main_photo',
        'og_img',
        'date',
        'time_pub',
        'meta_description',
        'company_id',
        'bank_id',
        'status',
        'show_in_slider',
        'the_author_answers',
        'author_id',
        'individual_signature',
        'related',
        'valid_until',
        'studied_the_topic',
        'read_the_sources',
        'write_articles',
        'table_of_contents',
        'pinned',
        'average_rating',
        'number_of_votes'
    ];

}
