<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BankATM extends Model
{
    use SoftDeletes;

    protected $table = 'bank_bankomates';

    protected $fillable = [
        'bank_atm_city_id',
        'alias',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'lead',
        'content',
        'average_rating',
        'number_of_votes',
        'status'
    ];
}
