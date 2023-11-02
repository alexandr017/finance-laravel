<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class Card12 extends Model
{
    protected $table = 'cards_12';

    protected $fillable = [
        'card_id',
        'type_of_acquiring',
        'maintenance_min',
        'maintenance_max',
        'commission_min',
        'commission_max',
        'field_of_activity',
        'terminal_rental',
        'accepted_cards',
        'types_of_payment_terminals',
        'speed_of_enrollment',
        'support',
        'connection_cost',
        'connection_terms',
        'modules_for_online_stores',
        'additional_services',
        'additional',
        'rate_qr_code',
        'government_payments',
         'everyday_goods',
        'for_all_other',
        'tariffs',
        'about_product',
        'advantages'
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

        $card->additional = (empty($request['advantages'])) ? null :  $request['advantages'];
        $card->save();
        return true;
    }


    public static function parse_fields($code,$card){
        $tmp = self::where('card_id',$card['id'])->first();
        if($tmp == null) return null;
        $card = self::find($tmp->id);
        $model_fields = $card->getFillable();
        foreach ($model_fields as $field) {

            if ($field == 'type_of_acquiring') {
                if ((int) $card->$field == 0) {
                    $type_of_acquiring = '<option selected value="0">Торговый</option><option value="1">Интернет</option><option value="2">Мобильный</option>';
                } else {
                    $type_of_acquiring = '<option value="0">Торговый</option><option selected value="1">Интернет</option><option value="2">Мобильный</option>';
                }

                $code = str_replace('{'.$field.'}', $type_of_acquiring, $code);
            }

            if(in_array($field,['rate_qr_code','for_all_other','commission_min','commission_max']) && $card->$field != null){
                $card->$field = str_replace(',','.',$card->$field);
            }

            $code = str_replace('{'.$field.'}', $card->$field, $code);
        }

        return $code;
    }

}
