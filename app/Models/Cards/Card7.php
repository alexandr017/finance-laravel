<?php

namespace App\Models\Cards;

use Illuminate\Database\Eloquent\Model;
use App\Models\SideBar\SidebarRating;
use DB;
use Cache;

class Card7 extends Model
{
    protected $table = 'cards_7';

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
        if($request['header_3'] == 0) {
            $this2->header_3 = 0;
        } else {
            $this2->header_3 = (empty($request['header_3'])) ? null :  $request['header_3'];
        }
        $this2->approval_indicator = (empty($request['approval_indicator'])) ? null :  $request['approval_indicator'];
        $this2->informer_scale = (empty($request['informer_scale'])) ? '' :  $request['informer_scale'];
        $this2->sum_min = (empty($request['sum_min'])) ? null :  $request['sum_min'];
        $this2->sum_max = (empty($request['sum_max'])) ? null :  $request['sum_max'];
        $this2->term_min = (empty($request['term_min'])) ? null :  $request['term_min'];
        $this2->term_max = (empty($request['term_max'])) ? null :  $request['term_max'];
        if($request['percent'] == 0) {
            $this2->percent = 0;
        } else {
            $this2->percent = (empty($request['percent'])) ? null :  $request['percent'];
        }
        $this2->age_min = (empty($request['age_min'])) ? null :  $request['age_min'];
        $this2->age_max = (empty($request['age_max'])) ? null :  $request['age_max'];
        $this2->pay_method = (empty($request['pay_method'])) ? null :  $request['pay_method'];
        $this2->payment_method = (empty($request['payment_method'])) ? null :  $request['payment_method'];
        $this2->docs = (empty($request['docs'])) ? null :  $request['docs'];
        $this2->review_speed = (empty($request['review_speed'])) ? null :  $request['review_speed'];
        $this2->payout_speed = (empty($request['payout_speed'])) ? null :  $request['payout_speed'];
        $this2->identification = (empty($request['identification'])) ? null :  $request['identification'];
        $this2->schedule = (empty($request['schedule'])) ? null :  $request['schedule'];
        $this2->poor_ch = (empty($request['poor_ch'])) ? 1 :  $request['poor_ch'];
        $this2->extension = (empty($request['extension'])) ? null :  $request['extension'];
        $this2->investors = (empty($request['investors'])) ? null :  $request['investors'];
        $this2->year = (empty($request['year'])) ? null :  $request['year'];
        $this2->additional = (empty($request['advantages'])) ? null :  $request['advantages'];
        $this2->text = (empty($request['text'])) ? null :  $request['text'];
        $this2->promocodes = (empty($request['promocodes'])) ? null :  $request['promocodes'];
        $this2->repayment = (empty($request['repayment'])) ? null :  $request['repayment'];


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
        $code = str_replace('{percent}', $card->percent, $code);
        $code = str_replace('{age_min}', $card->age_min, $code);
        $code = str_replace('{age_max}', $card->age_max, $code);
        $code = str_replace('{pay_method}', $card->pay_method, $code);
        $code = str_replace('{payment_method}', $card->payment_method, $code);
        $code = str_replace('{docs}', $card->docs, $code);
        $code = str_replace('{review_speed}', $card->review_speed, $code);
        $code = str_replace('{payout_speed}', $card->payout_speed, $code);
        $code = str_replace('{identification}', $card->identification, $code);
        $code = str_replace('{schedule}', $card->schedule, $code);
        $code = str_replace('{repayment}', $card->repayment, $code);


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
        $code = str_replace('{advantages}', $card->additional, $code);
        $code = str_replace('{text}', $card->text, $code);
        $code = str_replace('{promocodes}', $card->promocodes, $code);


        $all_icon_after_name_arr = [
            "1" => "Без процентов",
            "2" => "С плохой КИ",
            "3" => "Круглосуточно",
            "4" => "С продлением",
            "5" => "Моментальные",
            "6" => "Погашение по частям",
            "7" => "Микрофинансовая компания",
            "8" => "Микрокредитная компания",

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

    /*
    public static function ratingUpdate(){
        $sidebarRating = SidebarRating::all();
        $companies = DB::table("companies")
            ->leftJoin("urls","urls.section_id","companies.id")
            ->leftJoin("cards","cards.company_id","companies.id")
            ->leftJoin("cards_1_zaimy","cards_1_zaimy.card_id","cards.id")
            ->select("companies.*","urls.url",'cards_1_zaimy.approval_indicator','cards_1_zaimy.informer_scale','cards.km5','cards.link_1','cards.link_2','cards.link_type','cards.yandex_event')
            ->where(['companies.group_id'=>1,'urls.section_type'=>5,'companies.status'=>1,'cards.use_in_sidebar' => 1])
            ->orderBy('cards.km5','desc')
            ->orderBy('cards.id','asc')
            ->limit(5)
            ->get();


        $companiesArr = [];
        foreach ($companies as $key => $company) {
            $companiesArr[] =  $company->alias;
        }
        $sideArr = [];
        foreach ($sidebarRating as $key => $side){
            $sideArr [] = $side->alias;
        }


        $update = false;
        foreach ($sideArr as $key => $value){
            if($sideArr[$key] != $companiesArr[$key]) $update = true;
        }

        if($update){

            for($i=1; $i<6; $i++){
                $curentBDItem = SidebarRating::where(['id'=>$i])->first();
                $currentCompany = $companies[$i-1];
                $curentBDItem->alias = $currentCompany->alias;
                $curentBDItem->company_name = $currentCompany->h1;
                $last_pos = null;
                foreach ($sidebarRating as $key => $value){
                    if($value->company_name == $currentCompany->h1) $last_pos = $value->id;
                }
                $curentBDItem->last_pos = $last_pos;
                $curentBDItem->save();
                if(Cache::has('sidebar_k5m')) Cache::forget('sidebar_k5m');
            }
        }


    }
    */
}
