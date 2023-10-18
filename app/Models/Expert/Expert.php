<?php

namespace App\Models\Expert;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expert extends Model
{
    //use SoftDeletes;

    protected $table = 'experts';

    protected $fillable = [
        'name',
        'work_place',
        'email',
        'photo',
        'short_text',
        'full_text',
        'social_networks'
    ];

}
