<?php

namespace App\Models\Options;

use App\Models\BaseModel;

class RssManualControl extends BaseModel{

    protected $table = 'rss_manual_control';

    protected $fillable = [
        'section_id',
        'section_type',
        'date',
        'status'
    ];
}