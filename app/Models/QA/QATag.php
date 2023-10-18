<?php

namespace App\Models\QA;

use Illuminate\Database\Eloquent\Model;

class QATag extends Model
{
    protected $table = 'qa_tags';

    protected $fillable = [
        'category_title',
        'alias',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'status'
    ];

    public $timestamps = false;

    public function themes()
    {
        return $this->hasMany(QATheme::class, 'qa_tag_id');
    }
    public function post()
    {
        return $this->belongsTo(QATheme::class);
    }
    public function questions()
    {
        return $this->belongsToMany(QAQuestion::class,'qa_question_tags','qa_tag_id','qa_question_id');
    }
}
