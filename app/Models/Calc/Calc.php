<?php

namespace App\Models\Calc;

use App\Models\BaseModel;

class Calc extends BaseModel
{
    protected $table = 'calc';

    protected $fillable = [
        'calc_category_id',
        'company_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'img',
        'text_before',
        'text_after',
        'faq',
        'rating_count',
        'rating_value',
        'status'
    ];
}