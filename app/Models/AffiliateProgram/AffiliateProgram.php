<?php

namespace App\Models\AffiliateProgram;

use App\Models\BaseModel;

class AffiliateProgram extends BaseModel
{
    protected $table = 'affiliate_program';

    protected $fillable = ['name'];
}
