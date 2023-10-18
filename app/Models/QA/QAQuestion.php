<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Model;

class QAQuestion extends Model
{
    protected $table = 'qa_questions';

    protected $fillable = [
        'alias',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'user_id',
        'name',
        'question',
        'read_more_posts',
        'date_pub',
        'views',
        'status'
    ];

    public $timestamps = false;

    public function tags()
    {
        return $this->belongsToMany(QATag::class,'qa_question_tags','qa_question_id','qa_tag_id');
    }

    public function messages()
    {
        return $this->hasMany(QAAnswer::class, 'qa_question_id');
    }
}
