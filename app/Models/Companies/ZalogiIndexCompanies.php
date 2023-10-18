<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class ZalogiIndexCompanies extends Model
{
    protected $table = 'zalogi_index_companies';

    protected $fillable = [
        'region_id',
        'company_id',
    ];


}
