<?php

namespace App\Algorithms\Frontend;

class GlobalAlgorithms {

    /**
     * @param $str
     * @return mixed|null
     */
    public static function getMaxNumberWithPercentFromStr($str)
    {
        if (is_numeric($str)) {
            return $str;
        }

        $max_number = null;

        $str = preg_replace('/[\(\)=_]/','',$str);
        $str = str_replace('-',' ',$str);

        $wordArr = explode(' ', $str);

        //$wordArr2 = [];

        foreach ($wordArr as $item) {

            $tmp_item = preg_replace('/[\.\,]$/','',$item);
            //$wordArr2[] = $tmp_item;

            $tmp_number = (
                (int) $item . '%' == $tmp_item ||
                (float) $item . '%' == $tmp_item
            )
                ? str_replace('%','',$tmp_item)
                : null;

            if ($tmp_number > $max_number) {
                $max_number = $tmp_number;
            }

        }

        //dd($max_number);

        return $max_number;
    }
}