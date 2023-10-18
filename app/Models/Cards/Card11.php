<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;
use App\Models\SideBar\SidebarRating;
use DB;
use Cache;

class Card11 extends Model
{
    protected $table = 'cards_11';

    protected $fillable = [
        'card_id',
        'percent_min',
        'percent_max',
        'currency',
        'term',
        'sum_min',
        'sum_max',
        'term_min',
        'term_max',
        'replanishment',
        'auto_prolongation',
        'partial_withdrawal',
        'early_termination',
        'investment_feature',
        'percents_payment',
        'capitalization',
        'open_online',
        'special_conditions',
        'stock'
    ];

    public static function go($request, $card_id,$action){

        if($action == 'create'){
            $card = new self;
        } else {
            $tmp = self::where('card_id',$card_id)->first();
            if($tmp == null) return null;
            $card = self::find($tmp->id);
        }


        $model_fields = $card->getFillable();
        foreach ($model_fields as $field) {
            $card->$field = empty_str_to_null($request[$field]);
        }

        if ($action == 'create') {
            $card->card_id = $card_id;
        } else {
            $card->card_id = $request['id'];
        }

        if ($request['percent_min'] == 0) {
            $card->percent_min = 0;
        }


        $card->save();
        return true;
    }


    public static function parse_fields($code,$card){
        $tmp = self::where('card_id',$card['id'])->first();
        if($tmp == null) return null;
        $card = self::find($tmp->id);
        $model_fields = $card->getFillable();
        foreach ($model_fields as $field) {
            $code = str_replace('{'.$field.'}', $card->$field, $code);
        }

        return $code;
    }

}
