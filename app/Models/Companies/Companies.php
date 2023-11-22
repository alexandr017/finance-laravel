<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $fillable = [
        'title',
        'h1',
        'alias',
        'img',
        'meta_description',
        'breadcrumb',
        'text_before',
        'company_advantages',
        'og_img',
        'text_after',
        'support_link',
        'account_link',
        'reviews_link',
        'reviews_page',
        'card_category_id',
        'similars',
        'icons',
        'regions',
        'company_name',
        'link_vk',
        'link_facebook',
        'link_inst',
        'link_youtube',
        'link_ok',
        'link_twitter',
        'link_telegram',
        'author_id',
        'status',
        'closed'
    ];
}
