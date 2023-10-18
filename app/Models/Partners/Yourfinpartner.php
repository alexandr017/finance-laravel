<?php

namespace App\Models\Partners;

use Illuminate\Database\Eloquent\Model;

class Yourfinpartner extends Model
{
    protected $table = 'partners_yourfinpartner';

    protected $fillable = [
        'last_name',
        'first_name',
        'second_name',
        'passport_serial',
        'passport_number',
        'phone',
        'url',
        'reason',
        'sum',
        'status',
    ];

}
