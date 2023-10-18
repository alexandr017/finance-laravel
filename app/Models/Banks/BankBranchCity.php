<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BankBranchCity extends Model
{
    use SoftDeletes;

    protected $table = 'bank_branch_cities';

    protected $fillable = [
        'bank_id',
        'city_id',
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
