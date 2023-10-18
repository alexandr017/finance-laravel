<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Model;

class QAAnswer extends Model
{
    protected $table = 'qa_answers';

    protected $fillable = [
        'qa_question_id',
        'author_id',
        'author_name',
        'parent_id',
        'answer',
        'status'
    ];

    public function theme()
    {
        return $this->hasOne(QATheme::class, 'qa_theme_id');
    }

}
