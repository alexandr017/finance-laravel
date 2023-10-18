<?php

namespace App\Models\Insurance;

use Illuminate\Database\Eloquent\Model;

class InsuranceTagsGroups extends Model
{
    protected $table = 'insurance_tags_groups';

    protected $fillable = ['category_id','group_name'];
}
