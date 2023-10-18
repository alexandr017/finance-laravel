<?php

namespace App\Models\SubDomains;

use App\Models\BaseModel;

class SubDomainTagCategories extends BaseModel
{
    protected $table = 'sub_domains_tags_categories';

    protected $fillable = [
        'sub_domain_id',
        'category_id'
    ];
}