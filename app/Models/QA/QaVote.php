<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Model;

class QaVote extends Model
{
    protected $table = 'qa_votings';

    protected $fillable = [
        'answer_id',
        'ip',
        'vote'
    ];

    public $timestamps = false;
}
