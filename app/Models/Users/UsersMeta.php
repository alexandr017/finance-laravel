<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UsersMeta extends Model
{
    protected $table = 'users_meta';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'passport_date',
        'passport_series',
        'passport_number'
    ];
}
