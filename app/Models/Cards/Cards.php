<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\System as System;

class Cards extends Model
{
    protected $table = 'cards';

    public static function getCardByIds($list){
    	// govno-code start
	    $where = str_replace(',', ' or id=', $list);
	    $cardsRow = DB::select("select * from cards where id=$where");
	    foreach ($cardsRow as $key => $value) {
	        $cardsRow[$key]->category_id = System::getCardsTableNameById($value->category_id);
	    }

	    $cards2 = [];

	    $cardsColl = collect($cardsRow);
	    $cards2 = collect($cards2);
	    foreach ($cardsRow as $key => $value) {
	        $cards2[$key] = DB::table('cards')
	        ->leftjoin($value->category_id,'cards.id', $value->category_id.'.card_id')
	        ->where('cards.id',$value->id)
	        ->first();
	    }

	    $cards = collect([]);
	    foreach ($cardsRow as $key => $value) {
	        $cards [] = collect($value)->merge($cards2[$key]);
	    }

	    foreach ($cards as $key => $value) {
	        $cards[$key] = (object) $value;
	        foreach ($value as $key2 => $value2){
	            $cards[$key]->$key2 = $value2;
	        }
	    }
	    // govno-code finish


    	return $cards;
    }
}
