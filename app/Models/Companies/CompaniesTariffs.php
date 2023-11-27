<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class CompaniesTariffs extends Model
{
    protected $table = 'companies_tariffs';

    protected $fillable = ['title','sum_min','sum_max','term_min','term_max','percent','text','card_id','company_id'];
}