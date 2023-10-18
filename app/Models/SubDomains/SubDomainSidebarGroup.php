<?php

namespace App\Models\SubDomains;

use App\Models\BaseModel;

class SubDomainSidebarGroup extends BaseModel
{
    protected $table = 'sub_domains_sidebar_groups';

    protected $fillable = ['name','category_id','sorting'];
}