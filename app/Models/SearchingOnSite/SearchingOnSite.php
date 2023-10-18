<?php

namespace App\Models\SearchingOnSite;

use App\Models\BaseModel;

class SearchingOnSite extends BaseModel
{
    protected $table = 'searching_on_site';

    protected $fillable = ['text'];
}