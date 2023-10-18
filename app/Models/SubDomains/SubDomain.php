<?php

namespace App\Models\SubDomains;

use App\Models\BaseModel;

class SubDomain extends BaseModel
{
    protected $table = 'sub_domains';

    protected $fillable = ['city_id'];
}