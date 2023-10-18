<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;
use App\Models\Companies\CompaniesReviews;
use DB;
use URL;
use Auth;

class System extends Model
{
    public static function stripUrl($str){
    	$str = preg_replace('/^\//', '', $str);
    	$str = preg_replace('/\/$/', '', $str);
    	return $str;
    }

    public static function convertToArray($list,$field_for_value,$default_value = []){
    	$arr = [];
        if(count($default_value) != 0){
            foreach ($default_value as $key => $value) {
                $arr [$key] = $value;
            }
        }
    	foreach ($list as $key => $value) {
    		$arr [$value->id] = $value->$field_for_value;
    	}
    	return $arr;
    }

/*
-0.5
>-1
>=15-1.5
>=2-2
>=25-2.5
>=3-3
>=35-3.5
>=4-4
>=45-4.5
5-5
*/

    public static function rating($rating){
        $rating = str_replace(',', '.', $rating);
        $i_code = '';
/*
        if($rating==5){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star"></i>';
        }elseif($rating>=4.5){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-half-o"></i>';
        }elseif($rating>=4) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }elseif($rating>=3.5){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-half-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }elseif($rating>=3) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }elseif($rating>=2.5){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-half-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }elseif($rating>=2){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }elseif($rating>=1.5){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star-half-o"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }elseif($rating>=1){
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star-o"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }else{
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star-half-o"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star-o"></i><i data-value="0" data-item="3"  title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }
*/

        if($rating>=4.8){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/5.png"></span>';
        }elseif($rating>=4.25){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/4,5.png"></span>';
        }elseif($rating>=3.75) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/4.png"></span>';
        }elseif($rating>=3.25){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/3,5.png"></span>';
        }elseif($rating>=2.75) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/3.png"></span>';
        }elseif($rating>=2.25){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/2,5.png"></span>';
        }elseif($rating>=1.75){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/2.png"></span>';
        }elseif($rating>=1.25){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/1,5.png"></span>';
        }elseif($rating>=0.75){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/1.png"></span>';
        }else{
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/0,5.png"></span>';
        }
        /*
        1,25 - 1,74 - 1,5 звезды
        1,75 - 2,24 - 2 звезды
        2,25 - 2,74 - 2,5 звезды
        2,75 - 3,24 - 3 звезды
        3,25 - 3,74 - 3,5 звезды
        3,75 - 4,24 - 4 звезды
        4,25 - 4,79 - 4,5 звезды
        4,8 и выше - 5 звезд
        */

        return $i_code;
    }

    public static function nofollow($content){

        //ddd($content);

        if (Auth::id() == 12467  ||  Auth::id() == 30154) {
            //ddd('Вызов устарелой функции "nofollow" или Артур плохой человек.');
        }

        $content = str_replace('rel="noopener nofollow"','',$content);
        $content = str_replace('rel="noopener"','',$content);

        $regExpression = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";

        if(preg_match_all("/$regExpression/siU", $content, $matches, PREG_SET_ORDER)) {
            if( !empty($matches) ) {

                $targetUrl = 'https://finance.ru';
                for ($i=0; $i < count($matches); $i++)
                {

                    $tag = $matches[$i][0];
                    $tag2 = $matches[$i][0];
                    $url = $matches[$i][0];

                    $noFollow = '';

                    $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if( count($match) < 1 )
                        $noFollow .= ' target="_blank" ';

                    $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if( count($match) < 1 )
                        $noFollow .= ' rel="nofollow" ';

                    $pos = strpos($url,$targetUrl);
                    $relative = preg_match("/href=('|\")\/[^\/]/i", $url);
                    #dd(strpos($url,$targetUrl));
                    if (($pos === false) && ($relative == false)) {
                        $tag = rtrim ($tag,'>');
                        $tag .= $noFollow.'>';
                        $content = str_replace($tag2,$tag,$content);
                    }
                }
            }
        }

        $content = preg_replace_callback(
            '/<a href="https:\/\/vsezaimyonline\.ru\/[a-zA-z0-9_\/-]{1,}" target="_blank" rel="noopener nofollow">/m',
            function($reg){
                if(isset($reg[0]))
                    return;
                    //return str_replace(' rel="noopener nofollow"','',$reg[0]);
                else return;
            },
            $content
        );

        $content = preg_replace('/"\s>/siU','">',$content);

        return $content;


    }




    public static function getCurrentPage(){
        $url = Request::path();
        $url = preg_replace('/\/$/', '', $url);
        $urlArr = explode('/', $url);
        return $urlArr[count($urlArr)-1];
    }

    public static function getCurrentMonth($im_p=true){
        $month = date('m');
        switch ((int)$month) {
            case 1: return ($im_p) ? 'Январь' : 'Январе';
            case 2: return ($im_p) ? 'Февраль' : 'Феврале';
            case 3: return ($im_p) ? 'Март' : 'Марте';
            case 4: return ($im_p) ? 'Апрель' : 'Апреле';
            case 5: return ($im_p) ? 'Май' : 'Мае';
            case 6: return ($im_p) ? 'Июнь' : 'Июне';
            case 7: return ($im_p) ? 'Июль' : 'Июле';
            case 8: return ($im_p) ? 'Август' : 'Августе';
            case 9: return ($im_p) ? 'Сентябрь' : 'Сентябре';
            case 10: return ($im_p) ? 'Октябрь' : 'Октябре';
            case 11: return ($im_p) ? 'Ноябрь' : 'Ноябре';
            case 12: return ($im_p) ? 'Декабрь' : 'Декабре';
        }
        return $month;
    }


    public static function getCardsTableNameById($id){

        if (Auth::id() == 12467  ||  Auth::id() == 30154) {
            //ddd('Вызов устарелой функции "getCardsTableNameById" или Артур плохой человек.');
        }

        switch ($id) {
            case 1: return 'cards_1_zaimy';
            case 2: return 'cards_2_rko';
            case 3: return 'cards_3_zalogi';
            case 4: return 'cards_4_credits';
            case 5: return 'cards_5_credit_cards';
            case 6: return 'cards_6_debit_cards';
            case 7: return 'cards_7';

            default: return null;
        }        
    }

    public static function endWords($num, $words, $echo = true){

        $parent = $num;
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        if(!$echo)
            $parent = '';
        else
            $parent = $parent . ' ';
        switch ($num) {
            case 1: {
                return($words[0]);
            }
            case 2: case 3: case 4: {
                return($words[1]);
            }
            default: {
                return($words[2]);
            }
        }
    }

    public static function endWordsForLoansDays($num)
    {
        if ($num == 1 || $num == 21) {
            return 'дня';
        }

        return 'дней';

    }


    public static function reviewsParse($collection,$is_company_table=false){

        if (Auth::id() == 12467  ||  Auth::id() == 30154) {
            //ddd('Вызов устарелой функции "reviewsParse" или Артур плохой человек.');
        }


        foreach ($collection as $key => $value) {
            if(!$is_company_table){
                $reviews = CompaniesReviews::where(['company_id'=>$value->company_id,'status'=>1])->get();
            } else {
                $reviews = CompaniesReviews::where(['company_id'=>$value->id,'status'=>1])->get();
            }
                $realCount = 0; $ratingValue = 0; $ratingValueTmp = 0;
                foreach ($reviews as  $review) {
                    if($review->rating != null){
                        $ratingValueTmp += $review->rating;
                        $realCount++;
                    }
                }
                if($ratingValueTmp != 0){
                    $ratingValue = round($ratingValueTmp / $realCount,2);
                } else {
                    $ratingValue = 0;
                }
            $collection[$key]->ratingValue = $ratingValue;
            $collection[$key]->ratingCount = count($reviews);
        }
        return $collection;
    }

    public static function getRandomPassword($length = 10) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-$%^*!1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function usortAddishionFunction($a, $b, $field_name){
        if($f1->$field_name < $f2->$field_name) return -1;
        elseif($f1->$field_name > $f2->$field_name) return 1;
        else return 0;
    }

    public static function getCountChildListings($category_id){
        $countCards = DB::table('cards_children_pages')
            ->leftJoin('cards_childrens','cards_childrens.children_id','cards_children_pages.id')
            ->leftJoin('cards','cards.id','cards_childrens.card_id')
            ->select('cards_children_pages.alias',DB::raw("count(cards_childrens.card_id) as count"))
            ->where(['cards.category_id'=>$category_id,'cards.status'=>1])
            ->groupBy('cards_children_pages.alias')
            ->get();
        if($countCards != null){
            $tmpArr = [];
            foreach ($countCards as $key => $value) {
                $tmpArr [$value->alias] = $value->count;
            }
            #dd($tmpArr);
            return $tmpArr;
        }

        return null;
        
    }

 
}