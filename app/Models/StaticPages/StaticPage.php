<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = 'static_pages';

    protected $fillable = ['title', 'meta_description', 'h1', 'lead', 'content', 'alias', 'breadcrumbs'];

    public $timestamps = false;

}
