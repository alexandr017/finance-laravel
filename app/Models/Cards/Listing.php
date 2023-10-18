<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Config;
use App\Models\Urls\Url;
use App\Models\Traits\Status;

class Listing extends Model
{
    use SoftDeletes;
    use Status;

    protected $table = 'listings';

    protected $fillable = [
        'id',
        'category_id',
        'parent_id',
        'parent_table',
        'title',
        'meta_description',
        'h1',
        'breadcrumb',
        'expert_anchor',
        'h2',
        'img',
        'infographic',
        'lead',
        'content',
        'total_compare_label',
        'city_id',
        'number_in_exel',
        'average_rating',
        'number_of_votes',
        'status',
        'alias'
    ];

    public function urls()
    {
        $section_type = Config::get('urls-types.card-listings');

        return $this->hasOne(Url::class, 'section_id','id')
            ->where('section_type', $section_type);
    }

}