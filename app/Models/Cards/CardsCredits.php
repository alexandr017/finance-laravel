<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardsCredits extends Model
{
    protected $table = 'cards_4_credits';



    public static function go($request, $id,$action){

    	if($action == 'create'){
    		$this2 = new self;
    	} else {
    		$tmp = self::where('card_id',$id)->first();
    		if($tmp == null) return null;
    		$this2 = self::find($tmp->id);
    	}

    	if($action == 'create') $this2->card_id = $id;

        if(gettype($request['icon_after_name'])=='array'){
            $this2->icon_after_name = implode(',',$request['icon_after_name']);
        } else {
            $this2->icon_after_name = null;
        }

        $this2->header_1 = (empty($request['header_1'])) ? null :  $request['header_1'];
        $this2->header_2 = (empty($request['header_2'])) ? null :  $request['header_2'];
        $this2->header_3 = (float) str_replace(',', '.', $request['header_3']);
        $this2->approval_indicator = (empty($request['approval_indicator'])) ?null :  $request['approval_indicator'];
        $this2->informer_scale = (empty($request['informer_scale'])) ? '' :  $request['informer_scale'];
        $this2->sum_min = (empty($request['sum_min'])) ? null :  $request['sum_min'];
        $this2->sum_max = (empty($request['sum_max'])) ? null :  $request['sum_max'];
        $this2->term_min = (empty($request['term_min'])) ? null :  $request['term_min'];
        $this2->term_max = (empty($request['term_max'])) ? null :  $request['term_max'];
        //$this2->percent_min = (empty($request['percent_min'])) ? -1 :  $request['percent_min'];
        $this2->percent_min = (float) str_replace(',', '.', $request['percent_min']);
        $this2->percent_max = (float) str_replace(',', '.', $request['percent_max']);
        //$this2->percent_max = (empty($request['percent_max'])) ? -1 :  $request['percent_max'];
        $this2->age_min = (empty($request['age_min'])) ? null :  $request['age_min'];
        $this2->age_max = (empty($request['age_max'])) ? null :  $request['age_max'];
        $this2->licency = (empty($request['licency'])) ? null :  $request['licency'];
        $this2->docs = (empty($request['docs'])) ? null :  $request['docs'];
        $this2->speed_see = (empty($request['speed_see'])) ? null :  $request['speed_see'];
        $this2->register = (empty($request['register'])) ? null :  $request['register'];
        $this2->experience = (empty($request['experience'])) ? null :  $request['experience'];
        $this2->additional_field = (empty($request['additional'])) ? null :  $request['additional'];
        $this2->additional = (empty($request['advantages'])) ? null :  $request['advantages'];
        $this2->text = (empty($request['text'])) ? null :  $request['text'];

        $this2->save();
        return 1;
    }

    


    public static function parse_fields($code,$card){
		$tmp = self::where('card_id',$card['id'])->first();
		if($tmp == null) return null;
		$card = self::find($tmp->id);

    	$code = str_replace('{header_1}', $card->header_1, $code);
    	$code = str_replace('{header_2}', $card->header_2, $code);
    	$code = str_replace('{header_3}', $card->header_3, $code);
    	$code = str_replace('{approval_indicator}', $card->approval_indicator, $code);

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
    	$code = str_replace('{sum_min}', $card->sum_min, $code);
    	$code = str_replace('{sum_max}', $card->sum_max, $code);
    	$code = str_replace('{term_min}', $card->term_min, $code);
    	$code = str_replace('{term_max}', $card->term_max, $code);
        $code = str_replace('{percent_min}', $card->percent_min, $code);
        $code = str_replace('{percent_max}', $card->percent_max, $code);
        $code = str_replace('{age_min}', $card->age_min, $code);
        $code = str_replace('{age_max}', $card->age_max, $code);
        $code = str_replace('{licency}', $card->licency, $code);
        $code = str_replace('{docs}', $card->docs, $code);
        $code = str_replace('{speed_see}', $card->speed_see, $code);
        $code = str_replace('{register}', $card->register, $code);
        $code = str_replace('{experience}', $card->experience, $code);
        $code = str_replace('{additional}', $card->additional_field, $code);
        $code = str_replace('{term_max}', $card->term_max, $code);
        $code = str_replace('{advantages}', $card->additional, $code);
        $code = str_replace('{text}', $card->text, $code);


        $all_icon_after_name_arr = [
            "1" => "Наличными",
            "2" => "По паспорту",
            "3" => "Без залога",
            "4" => "Без поручителей",
            "5" => "Под залог автомобиля",
            "6" => "Под залог недвижимости",
            "7" => "Под поручительство",
            "8" => "Аннуитетные платежи",
            "9" => "Дифференцированные платежи",

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
