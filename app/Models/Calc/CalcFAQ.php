<?php

namespace App\Models\Calc;

use App\Models\BaseModel;

class CalcFAQ extends BaseModel
{
    protected $table = 'calc_faq';

    protected $fillable = [
        'question',
        'answer'
    ];
}