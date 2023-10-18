<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardsZalogi extends Model
{
    protected $table = 'cards_3_zalogi';


	public static function go($request, $id,$action){

    	if($action == 'create'){
    		$this2 = new self;
    	} else {
    		$tmp = self::where('card_id',$id)->first();
    		if($tmp == null) return null;
    		$this2 = self::find($tmp->id);
    	}

    	if($action == 'create') $this2->card_id = $id;



        $this2->zalog_type = (empty($request['zalog_type'])) ? null :  $request['zalog_type'];
        $this2->sum_min = (empty($request['sum_min'])) ? null :  $request['sum_min'];
        $this2->sum_max = (empty($request['sum_max'])) ? null :  $request['sum_max'];

        $this2->term_min = (empty($request['term_min'])) ? null :  $request['term_min'];
        $this2->term_max = (empty($request['term_max'])) ? null :  $request['term_max'];
        $this2->percent_min = (empty($request['percent_min'])) ? null :  $request['percent_min'];
        $this2->percent_max = (empty($request['percent_max'])) ? null :  $request['percent_max'];

        $this2->year = (empty($request['year'])) ? null :  $request['year'];
        $this2->licency = (empty($request['licency'])) ? null :  $request['licency'];
        $this2->docs = (empty($request['docs'])) ? null :  $request['docs'];
    	$this2->work_time = (empty($request['work_time'])) ? null :  $request['work_time'];
        $this2->repayment = (empty($request['repayment'])) ? null :  $request['repayment'];
        $this2->investors = (empty($request['investors'])) ? null :  $request['investors'];
        $this2->additional_field = (empty($request['additional'])) ? null :  $request['additional'];

        $this2->additional = (empty($request['advantages'])) ? null :  $request['advantages'];
        $this2->text = (empty($request['text'])) ? null :  $request['text'];
        //$this2->text = (empty($request['text'])) ? '' :  $request['text'];

        $this2->save();
        return 1;
    }



    public static function parse_fields($code,$card){
		$tmp = self::where('card_id',$card['id'])->first();
		if($tmp == null) return null;
		$card = self::find($tmp->id);
/*
    	$code = str_replace('{header_1}', $card->header_1, $code);
    	$code = str_replace('{header_2}', $card->header_2, $code);
    	$code = str_replace('{header_3}', $card->header_3, $code);
    	$code = str_replace('{approval_indicator}', $card->approval_indicator, $code);
        */

        $code = str_replace('{zalog_type}', $card->zalog_type, $code);
    	$code = str_replace('{sum_min}', $card->sum_min, $code);
    	$code = str_replace('{sum_max}', $card->sum_max, $code);
    	$code = str_replace('{term_min}', $card->term_min, $code);
    	$code = str_replace('{term_max}', $card->term_max, $code);
    	$code = str_replace('{percent_min}', $card->percent_min, $code);
    	$code = str_replace('{percent_max}', $card->percent_max, $code);
    	$code = str_replace('{year}', $card->year, $code);
    	$code = str_replace('{licency}', $card->licency, $code);
    	$code = str_replace('{docs}', $card->docs, $code);
    	$code = str_replace('{work_time}', $card->work_time, $code);
    	$code = str_replace('{repayment}', $card->repayment, $code);
    	$code = str_replace('{investors}', $card->investors, $code);
        $code = str_replace('{additional_field}', $card->additional_field, $code);
    	$code = str_replace('{additional}', $card->additional, $code);
    	$code = str_replace('{text}', $card->text, $code);
    	//$code = str_replace('{text}', $card->text, $code);

        return $code;
    }
    

}
