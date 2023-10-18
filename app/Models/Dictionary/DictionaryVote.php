<?php

namespace App\Models\Dictionary;

use Illuminate\Database\Eloquent\Model;

class DictionaryVote extends Model
{
    protected $table = 'dictionary_votings';

    protected $fillable = [
      'term_id',
      'ip',
      'vote'
    ];

    public $timestamps = false;
}
