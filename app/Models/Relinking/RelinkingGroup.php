<?php

namespace App\Models\Relinking;

use Illuminate\Database\Eloquent\Model;

class RelinkingGroup extends Model
{
    protected $table = 'relinking_groups';

    protected $fillable = ['group_name', 'sort_order','category_id'];

    public $timestamps = false;
}
