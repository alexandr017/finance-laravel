<?php

namespace App\Models\Insurance;

use App\Models\BaseModel;
use DB;

class InsuranceCardPages extends BaseModel
{
    protected $table = 'insurance_cards_pages';

    protected $fillable = [
        'card_id',
        'page_id'
    ];

    /**
     * @param $card_id
     * @param $pages
     */
    public static function add($card_id, $pages)
    {
        foreach ($pages as $page) {
            DB::insert("insert into insurance_cards_pages (card_id,page_id) values (?,?)",[$card_id,$page]);
        }
    }

    /**
     * @param $card_id
     * @param $pages
     */
    public static function change($card_id, $pages)
    {
        DB::delete("delete from insurance_cards_pages where card_id=?",[$card_id]);
        foreach ($pages as $page) {
            DB::insert("insert into insurance_cards_pages (card_id,page_id) values (?,?)",[$card_id,$page]);
        }
    }

}