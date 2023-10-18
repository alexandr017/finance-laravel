<?php

namespace App\Models\Banks;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BankInfoPage extends Model
{
    use SoftDeletes;

    protected $table = 'bank_info_pages';

    protected $fillable = [
        'bank_id',
        'type_id',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'content',
        'average_rating',
        'number_of_votes',
        'status'
    ];

}
