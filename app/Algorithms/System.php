<?php

namespace App\Algorithms;

use Illuminate\Database\Eloquent\Model;
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


    public static function rating($rating){
        $rating = str_replace(',', '.', $rating);

        if($rating>=4.8){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/5.png)"></span>';
        }elseif($rating>=4.25){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/4,5.png)"></span>';
        }elseif($rating>=3.75) {
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/4.png)"></span>';
        }elseif($rating>=3.25){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/3,5.png)"></span>';
        }elseif($rating>=2.75) {
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/3.png)"></span>';
        }elseif($rating>=2.25){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/2,5.png)"></span>';
        }elseif($rating>=1.75){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/2.png)"></span>';
        }elseif($rating>=1.25){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/1,5.png)"></span>';
        }elseif($rating>=0.75){
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/1.png)"></span>';
        }else{
            $i_code = '<span class="star_span" style="background:url(/old_theme/img/stars/0,5.png)"></span>';
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

//
//Response::macro('adminPanel', function(){
//    $id = Auth::id();
//    if($id != null){
//        $roleDB = DB::select("select * from role_user where user_id=?",[$id]);
//        if(isset($roleDB[0])){
//            if($roleDB[0]->role_id == 1){
//                $userMeta = UsersMeta::where(['user_id'=>$id])->first();
//                if($userMeta!=null){
//                    return $userMeta->admin_panel;
//                }
//            }
//        }
//    }
//    return -1;
//});
//
//Response::macro('getCanonical', function(){
//    $url = URL::current();
//    $canonical = preg_replace("/\/page\/\d/", '', $url);
//    if(strstr($url,'page'))
//        $canonical = preg_replace("/\d\d?\d?$/", '', $canonical);
//    return $canonical;
//});
//
//Response::macro('getCanonicalNext', function($section_id,$pages){
//    if($section_id == 7){
//        if($pages == 1) return null;
//        $url = URL::current();
//        $url = preg_replace('/\/$/', '', $url);
//        $urlArr = explode('/', $url);
//        $page = (int)$urlArr[count($urlArr)-1];
//        if($page < $pages){
//            if($page == 0) {
//                return $url . '/page/2';
//            } else {
//                return str_replace('/page/'.$page, '/page/'.($page+1), $url);
//            }
//        } return null;
//    }
//    return null;
//});
//
//Response::macro('getCanonicalPrev', function($section_id){
//    if($section_id == 7){
//        $url = URL::current();
//        $url = preg_replace('/\/$/', '', $url);
//        $urlArr = explode('/', $url);
//        $page = (int) $urlArr[count($urlArr)-1];
//        if($page > 2){
//            return str_replace('/page/'.$page, '/page/'.($page-1), $url);
//        } elseif($page == 2){
//            return str_replace('/page/'.$page, '', $url);
//        } else return null;
//    }
//    return null;
//});

}