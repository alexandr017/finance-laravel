<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * Post
 *
 * @mixin Eloquent
 */
class StaticPage extends Model
{
    protected $table = 'static_pages';

    protected $fillable = ['title', 'meta_description', 'h1', 'lead', 'content', 'alias', 'breadcrumbs', 'average_rating', 'number_of_votes'];

    public $timestamps = false;

    public static function findByAlias()
    {
        $alias = clear_data(\Request::path());

        return StaticPage::where(['alias' => $alias])->first();
    }


}
