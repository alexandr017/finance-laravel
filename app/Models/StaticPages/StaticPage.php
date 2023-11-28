<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Request;

/**
 * Post
 *
 * @mixin Eloquent
 * @property mixed $h1
 */
class StaticPage extends Model
{
    protected $table = 'static_pages';

    protected $fillable = ['title', 'meta_description', 'h1', 'lead', 'content', 'alias', 'breadcrumbs', 'average_rating', 'number_of_votes'];

    public $timestamps = false;

    public static function findByAlias() : ?StaticPage
    {
        $alias = clear_data(Request::path());

        return StaticPage::where(['alias' => $alias])->first();
    }


}
