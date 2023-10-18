<?php

namespace App\Models\SubDomains;

use App\Models\BaseModel;

class SubDomainTagTemplate extends BaseModel
{
    protected $table = 'sub_domains_tag_templates';

    protected $fillable = [
        'listing_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'text_before',
        'text_after',
        'rating_count',
        'rating_value',
        'sidebar_group',
        'status'
    ];
}