<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class Card10 extends Model
{
    protected $table = 'cards_10';

    protected $fillable = [
        'card_id',
        'header_1',
        'header_2',
        'header_3',
        'approval_indicator',
        'informer_scale',
        'sum_min',
        'sum_max',
        'an_initial_fee_min',
        'an_initial_fee_max',
        'term_min',
        'term_max',
        'percent_min',
        'percent_max',
        'target',
        'procuring',
        'borrower',
        'age_min',
        'age_max',
        'experience',
        'income_min',
        'income_max',
        'docs',
        'review_speed',
        'validity_of_a_positive_decision',
        'additionally_field',
        'repayment_methods',
        'payments',
        'early_repayment',
        'additional',
        'text'
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



        if ($request['header_3'] == 0) {
            $card->header_3 = 0;
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


        $special_replace = ['informer_scale'];
        

        $informer_scaleValues = ['400' => 400,'600' => 600, '1000'=>1000];
        $informer_scale = '';
        foreach ($informer_scaleValues as $key => $value) {
            if($card->informer_scale == $key){
                $informer_scale = $informer_scale . '<option value="'.$key.'" selected="selected">' . $value . '</option>';
            } else {
                $informer_scale = $informer_scale . '<option value="'.$key.'">' . $value . '</option>';
            }
        }
        $code = str_replace('{informer_scale}', $informer_scale, $code);


        $model_fields = $card->getFillable();
        foreach ($model_fields as $field) {
            if (! in_array($field, $special_replace)) {
                $code = str_replace('{'.$field.'}', $card->$field, $code);
            }
        }

        return $code;
    }

}
