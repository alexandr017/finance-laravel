<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;

class CardsRko extends Model
{
    protected $table = 'cards_2_rko';

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

        $this2->opened = (empty($request['opened'])) ? null :  $request['opened'];
        if($request['opened'] == 0) $this2->opened = 0;
        $this2->maintenance = (empty($request['maintenance'])) ? null :  $request['maintenance'];
        if($request['maintenance'] == 0) $this2->maintenance = 0;
        $this2->count_payment = (empty($request['count_payment'])) ? null :  $request['count_payment'];

        $this2->speed_opened = (empty($request['speed_opened'])) ? null :  $request['speed_opened'];
        $this2->licency = (empty($request['licency'])) ? '' :  $request['licency'];
        $this2->internet_bank = (empty($request['internet_bank'])) ? null :  $request['internet_bank'];
        if($request['internet_bank'] == '0') $this2->internet_bank = 0;

        $this2->mobile_bank = (empty($request['mobile_bank'])) ? null :  $request['mobile_bank'];
        if($request['mobile_bank'] == '0') $this2->mobile_bank = 0;
        $this2->sms_info = (empty($request['sms_info'])) ? null :  $request['sms_info'];
        $this2->docs = (empty($request['docs'])) ? null :  $request['docs'];
        $this2->set_payment = (empty($request['set_payment'])) ? null :  $request['set_payment'];
        $this2->get_payment = (empty($request['get_payment'])) ? null :  $request['get_payment'];
        $this2->additional_field = (empty($request['additional'])) ? null :  $request['additional'];
        $this2->corporate_cards = (empty($request['corporate_cards'])) ? null :  $request['corporate_cards'];
        $this2->intenernet_acquiring = (empty($request['intenernet_acquiring'])) ? null :  $request['intenernet_acquiring'];
        $this2->acquiring_terms_connect = (empty($request['acquiring_terms_connect'])) ? null :  $request['acquiring_terms_connect'];
        $this2->acquiring_support = (empty($request['acquiring_support'])) ? null :  $request['acquiring_support'];
        $this2->support_module_for_shop = (empty($request['support_module_for_shop'])) ? null :  $request['support_module_for_shop'];
        $this2->acquiring_terms_enlistment = (empty($request['acquiring_terms_enlistment'])) ? null :  $request['acquiring_terms_enlistment'];
        $this2->acquiring_additional_services = (empty($request['acquiring_additional_services'])) ? null :  $request['acquiring_additional_services'];
        $this2->salary_project = (empty($request['salary_project'])) ? null :  $request['salary_project'];
        $this2->salary_project_speed = (empty($request['salary_project_speed'])) ? null :  $request['salary_project_speed'];
        $this2->salary_project_additional_services = (empty($request['salary_project_additional_services'])) ? null :  $request['salary_project_additional_services'];
        $this2->currency_control = (empty($request['currency_control'])) ? null :  $request['currency_control'];
        $this2->exchange_control_opened = (empty($request['exchange_control_opened'])) ? null :  $request['exchange_control_opened'];
        $this2->exchange_control_account = (empty($request['exchange_control_account'])) ? null :  $request['exchange_control_account'];
        $this2->salary_project_agent = (empty($request['salary_project_agent'])) ? null :  $request['salary_project_agent'];
        $this2->exchange_control_passport = (empty($request['exchange_control_passport'])) ? null :  $request['exchange_control_passport'];
        $this2->exchange_control_charge = (empty($request['exchange_control_charge'])) ? null :  $request['exchange_control_charge'];
        $this2->exchange_control_reference = (empty($request['exchange_control_reference'])) ? null :  $request['exchange_control_reference'];
        $this2->exchange_control_additional_services = (empty($request['exchange_control_additional_services'])) ? null :  $request['exchange_control_additional_services'];
        $this2->onep_bonus = (empty($request['onep_bonus'])) ? null :  $request['onep_bonus'];

        $this2->transfers_to_individuals = (empty($request['transfers_to_individuals'])) ? null :  $request['transfers_to_individuals'];
        $this2->interest_on_balance = (empty($request['interest_on_balance'])) ? null :  $request['interest_on_balance'];
        $this2->spread = (empty($request['spread'])) ? null :  $request['spread'];


        $this2->additional = (empty($request['advantages'])) ? null :  $request['advantages'];
        $this2->text = (empty($request['text'])) ? null :  $request['text'];

        $this2->guarantee_types = (empty($request['guarantee_types'])) ? null :  $request['guarantee_types'];
        $this2->guarantee_sum = (empty($request['guarantee_sum'])) ? null :  $request['guarantee_sum'];
        $this2->guarantee_commission = (empty($request['guarantee_commission'])) ? null :  $request['guarantee_commission'];
        $this2->guarantee_secure = (empty($request['guarantee_secure'])) ? null :  $request['guarantee_secure'];
        $this2->guarantee_project_speed = (empty($request['guarantee_project_speed'])) ? null :  $request['guarantee_project_speed'];
        $this2->guarantee_spec_account_speed = (empty($request['guarantee_spec_account_speed'])) ? null :  $request['guarantee_spec_account_speed'];
        $this2->guarantee_project_additional_services = (empty($request['guarantee_project_additional_services'])) ? null :  $request['guarantee_project_additional_services'];



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
        */

    	$code = str_replace('{opened}', $card->opened, $code);
    	$code = str_replace('{maintenance}', $card->maintenance, $code);
    	$code = str_replace('{count_payment}', $card->count_payment, $code);
    	$code = str_replace('{speed_opened}', $card->speed_opened, $code);
    	$code = str_replace('{licency}', $card->licency, $code);
    	$code = str_replace('{internet_bank}', $card->internet_bank, $code);
    	$code = str_replace('{mobile_bank}', $card->mobile_bank, $code);
    	$code = str_replace('{sms_info}', $card->sms_info, $code);
    	$code = str_replace('{docs}', $card->docs, $code);
    	$code = str_replace('{set_payment}', $card->set_payment, $code);
    	$code = str_replace('{get_payment}', $card->get_payment, $code);
    	$code = str_replace('{additional_field}', $card->additional_field, $code);
    	$code = str_replace('{corporate_cards}', $card->corporate_cards, $code);
        $code = str_replace('{intenernet_acquiring}', $card->intenernet_acquiring, $code);
        $code = str_replace('{acquiring_terms_connect}', $card->acquiring_terms_connect, $code);
        $code = str_replace('{acquiring_support}', $card->acquiring_support, $code);
        $code = str_replace('{support_module_for_shop}', $card->support_module_for_shop, $code);
        $code = str_replace('{acquiring_terms_enlistment}', $card->acquiring_terms_enlistment, $code);
        $code = str_replace('{acquiring_additional_services}', $card->acquiring_additional_services, $code);
        $code = str_replace('{salary_project}', $card->salary_project, $code);
        $code = str_replace('{salary_project_speed}', $card->salary_project_speed, $code);
        $code = str_replace('{salary_project_agent}', $card->salary_project_agent, $code);
        $code = str_replace('{salary_project_additional_services}', $card->salary_project_additional_services, $code);
        $code = str_replace('{currency_control}', $card->currency_control, $code);
        $code = str_replace('{exchange_control_opened}', $card->exchange_control_opened, $code);
        $code = str_replace('{exchange_control_account}', $card->exchange_control_account, $code);
        $code = str_replace('{exchange_control_passport}', $card->exchange_control_passport, $code);
        $code = str_replace('{exchange_control_charge}', $card->exchange_control_charge, $code);
        $code = str_replace('{exchange_control_charge}', $card->exchange_control_charge, $code);
        $code = str_replace('{exchange_control_reference}', $card->exchange_control_reference, $code);
        $code = str_replace('{exchange_control_additional_services}', $card->exchange_control_additional_services, $code);
        $code = str_replace('{onep_bonus}', $card->onep_bonus, $code);
        $code = str_replace('{advantages}', $card->additional, $code);
    	$code = str_replace('{text}', $card->text, $code);
    	$code = str_replace('{transfers_to_individuals}', $card->transfers_to_individuals, $code);
    	$code = str_replace('{interest_on_balance}', $card->interest_on_balance, $code);
    	$code = str_replace('{spread}', $card->spread, $code);

        $code = str_replace('{guarantee_types}', $card->guarantee_types, $code);
        $code = str_replace('{guarantee_sum}', $card->guarantee_sum, $code);
        $code = str_replace('{guarantee_commission}', $card->guarantee_commission, $code);
        $code = str_replace('{guarantee_secure}', $card->guarantee_secure, $code);
        $code = str_replace('{guarantee_project_speed}', $card->guarantee_project_speed, $code);
        $code = str_replace('{guarantee_spec_account_speed}', $card->guarantee_spec_account_speed, $code);
        $code = str_replace('{guarantee_project_additional_services}', $card->guarantee_project_additional_services, $code);

/*
    	$scheduleValues = ['1' => 'Да','0' => 'Нет'];
    	$schedule = '';
    	foreach ($scheduleValues as $key => $value) {
    		if($card->schedule == $key){
    			$schedule = $schedule . '<option value="'.$key.'" selected="selected">' . $value . '</option>'; 
    		} else {
    			$schedule = $schedule . '<option value="'.$key.'">' . $value . '</option>'; 
    		}
    	}
    	$code = str_replace('{poor_ch}', $schedule, $code);

    	$code = str_replace('{extension}', $card->extension, $code);
    	$code = str_replace('{investors}', $card->investors, $code);
    	$code = str_replace('{year}', $card->year, $code);
    	$code = str_replace('{advantages}', $card->advantages, $code);
    	$code = str_replace('{text}', $card->text, $code);
    	$code = str_replace('{promo}', $card->promo, $code);
*/


        $all_icon_after_name_arr = [
            "1" => "Зарплатный проект",
            "2" => "Корпоративные карты",
            "3" => "Торговый эквайринг",
            "4" => "Интернет-эквайринг",
            "5" => "Валютный контроль",
            "6" => "Интернет-бухгалтерия",
            "7" => "Гарантии",
            "8" => "Регистрация бизнеса",
            "9" => "Рекомендовано для ИП",
            "10" => "Рекомендовано для ООО",
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
