<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectRating extends Model
{
    protected $table = 'project_rating';

    protected $fillable = [
        'average_rating',
        'number_of_votes'
    ];

    public $timestamps = false;

}
