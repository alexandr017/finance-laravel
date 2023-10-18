<?php

namespace App\Models\PoolVoting;

use Illuminate\Database\Eloquent\Model;


class PoolVotingTest extends Model
{
    protected $table = 'pool_voting_test';

    protected $fillable = [
        'metrika_id',
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'question_6',
        'question_7',
        'question_8',
        'question_9'
    ];
}