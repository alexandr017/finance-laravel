<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class DaysOffCompanies extends Model
{
    protected $table = 'companies_weekend';

    protected $fillable = [
        'company_id',
        'day_off',
    ];

    public $timestamps = false;
}
