<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    protected $table = 'cities_region';

    protected $fillable = [
        'region'
    ];
}
