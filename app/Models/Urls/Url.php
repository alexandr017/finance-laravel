<?php

namespace App\Models\Urls;

use App\Models\BaseModel;
use DB;

class Url extends BaseModel
{
    protected $table = 'urls';

    protected $fillable = ['url','section_type', 'section_id'];

    public $timestamps = false;

    public static function pushLink($url, $section_id, $section_type) : void
    {
        DB::insert("insert into urls (url,section_id,section_type) values (?,?,?)",[$url, $section_id, $section_type]);
    }

    public static function updateLink($url, $section_id, $section_type) : void
    {
        DB::update("update urls set url=? where section_id=? and section_type=?",[$url, $section_id, $section_type]);
    }

    public static function deleteLink($section_id, $section_type) : void
    {
        DB::delete("delete from urls where section_id=? and section_type=?",[$section_id, $section_type]);
    }



}