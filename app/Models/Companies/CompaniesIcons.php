<?php

namespace App\Models\Companies;

use App\Models\BaseModel;

class CompaniesIcons extends BaseModel
{
    protected $table = 'companies_icons';

    protected $fillable = [
        'icon_label',
        'icon_name',
        'category_id'
    ];

    public $timestamps = false;
}