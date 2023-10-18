<?php

namespace App\Algorithms\Frontend\Cards;

class CardDate
{
    public static function setUpdateDate($timestamp)
    {
        $d = date('d',strtotime($timestamp));
        $m = ($d>date('d')) ? ((int)date('m')) : date('m');
        $Y = date('Y');
        if($d > date('d')){
            $m--;
        }
        if($m == 0){
            $Y--;
            $m = 12;
        }
        if($m < 10){
            $m = '0'.$m;
        }
        if(($d > 28) && ($m == 2)) $d = '27';
        if(strstr($m,'00')) $m = str_replace('00','0',$m);

        return $d.'.'.$m.'.'.$Y;
    }
}