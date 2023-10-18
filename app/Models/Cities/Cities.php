<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'region_id',
        'imenitelny',
        'roditelny',
        'datelny',
        'vinitelny',
        'tvoritelny',
        'predlogny' ,
        'transliteration'
    ];
}
