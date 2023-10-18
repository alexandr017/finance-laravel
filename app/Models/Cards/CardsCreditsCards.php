<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardsCreditsCards extends Model
{
    protected $table = 'cards_5_credit_cards';



    public static function go($request, $id,$action){

    	if($action == 'create'){
    		$this2 = new self;
    	} else {
    		$tmp = self::where('card_id',$id)->first();
    		if($tmp == null) return null;
    		$this2 = self::find($tmp->id);
    	}

    	if($action == 'create') $this2->card_id = $id;

        $this2->informer_scale = (empty($request['informer_scale'])) ? null :  $request['informer_scale'];

        if(gettype($request['icon_after_name'])=='array'){
            $this2->icon_after_name = implode(',',$request['icon_after_name']);
        } else {
            $this2->icon_after_name = null;
        }

        $this2->limit_max = (empty($request['limit_max'])) ? null :  $request['limit_max'];
        $this2->percent_min = (empty($request['percent_min'])) ? null :  $request['percent_min'];
        $this2->percent_max = (empty($request['percent_max'])) ? null :  $request['percent_max'];
        $this2->none_percent_period = (empty($request['none_percent_period'])) ? null :  $request['none_percent_period'];
        if($request['opened'] == 0){
            $this2->opened = 0;
        } else {
            $this2->opened = (empty($request['opened'])) ? null :  $request['opened'];
        }
        if($request['maintenance'] == 0){
            $this2->maintenance = 0;
        } else {
            $this2->maintenance = (empty($request['maintenance'])) ? null :  $request['maintenance'];
        }
        $this2->other_maintenance = (empty($request['other_maintenance'])) ? null :  $request['other_maintenance'];
        $this2->age_min = (empty($request['age_min'])) ? null :  $request['age_min'];
        $this2->age_max = (empty($request['age_max'])) ? null :  $request['age_max'];


        $this2->speed_see = (empty($request['speed_see'])) ? null :  $request['speed_see'];
        $this2->age_work = (empty($request['age_work'])) ? null :  $request['age_work'];
        $this2->licency = (empty($request['licency'])) ? null :  $request['licency'];
        $this2->docs = (empty($request['docs'])) ? null :  $request['docs'];
        $this2->register = (empty($request['register'])) ? null :  $request['register'];
        $this2->experience = (empty($request['experience'])) ? null :  $request['experience'];
        $this2->additional_field = (empty($request['additional'])) ? null :  $request['additional'];
        $this2->cache_back = (empty($request['cache_back'])) ? null :  $request['cache_back'];

        $this2->additional = (empty($request['advantages'])) ? '' :  $request['advantages'];
        $this2->text = (empty($request['text'])) ? '' :  $request['text'];

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
        */

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

        $code = str_replace('{limit_max}', $card->limit_max, $code);
        $code = str_replace('{percent_min}', $card->percent_min, $code);
        $code = str_replace('{percent_max}', $card->percent_max, $code);
        $code = str_replace('{none_percent_period}', $card->none_percent_period, $code);
        $code = str_replace('{opened}', $card->opened, $code);
        $code = str_replace('{maintenance}', $card->maintenance, $code);
        $code = str_replace('{other_maintenance}', $card->other_maintenance, $code);
        $code = str_replace('{age_min}', $card->age_min, $code);
        $code = str_replace('{age_max}', $card->age_max, $code);
        $code = str_replace('{speed_see}', $card->speed_see, $code);
        $code = str_replace('{age_work}', $card->age_work, $code);
        $code = str_replace('{licency}', $card->licency, $code);
        $code = str_replace('{docs}', $card->docs, $code);
        $code = str_replace('{register}', $card->register, $code);
        $code = str_replace('{experience}', $card->experience, $code);
        $code = str_replace('{additional}', $card->additional_field, $code);
        $code = str_replace('{cache_back}', $card->cache_back, $code);
        $code = str_replace('{advantages}', $card->additional, $code);
        $code = str_replace('{text}', $card->text, $code);

        $all_icon_after_name_arr = [
            "1" => "МИР",
            "2" => "Visa",
            "3" => "MasterCard",
            "4" => "Apple Pay",
            "5" => "Samsung Pay",
            //"6" => "Android Pay",
            //"7" => "American Express",
            "8" => "PayPass",
            "9" => "GooglePay",
            "10" => "PayWave",
            "11" => "3D Secure",
            "12" => "Garmin Pay",
            "13" => "Мир Бесконтактная",

            "14" => 'Моментальная (Momentum)',
            "15" => 'Виртуальная (Virtual)',
            "16" => 'Классическая (Classic)',
            "17" => 'Золотая (Gold)',
            "18" => 'Платиновая (Platinum)',
            "19" => 'Премиальная (Premium)',
            "20" => 'Черная (Black)',
            "21" => 'Индивидуальный дизайн',
            "22" => 'American Express',
            "23" => 'UnionPay и QuickPass',
            "24" => 'Мир Pay',
            "25" => 'Maestro',

        ];
        $cart_icon_after_name_arr = explode(',',$card->icon_after_name);
        $icon_after_name = '';
        //dd($cart_icon_after_name_arr);
        foreach ($all_icon_after_name_arr as $key => $value) {
            $is_check = false;
            foreach ($cart_icon_after_name_arr as $key2 => $value2) {
                if($key == $value2) $is_check = true;
            }
            if($is_check){
                $icon_after_name .= "<div class=\"checkbox width-33\"><label><input name=\"icon_after_name[]\" value=\"$key\" type=\"checkbox\" checked=\"true\"> $value</label></div>";
            } else {
                $icon_after_name .= "<div class=\"checkbox width-33\"><label><input name=\"icon_after_name[]\" value=\"$key\" type=\"checkbox\"> $value</label></div>";
            }
        }
    	$code = str_replace('{icon_after_name}', $icon_after_name, $code);

        return $code;
    }

    
}
