<?php

namespace App\Algorithms\Frontend;

class RatingParser {

    /**
     * @param $rating
     * @return string
     */
    public static function getCssClassForBackground($rating){

        if($rating > 4.5){
            return 'r_bg_5';
        } elseif($rating > 3.5){
            return 'r_bg_4';
        } elseif($rating > 2.5){
            return 'r_bg_3';
        } elseif($rating > 2.5){
            return 'r_bg_3';
        } elseif($rating > 1.5){
            return 'r_bg_2';
        } elseif($rating > 0.5){
            return 'r_bg_1';
        } elseif($rating > 0){
            return '';
        }

    }

    /**
     * @param $rating
     * @return string
     */
    public static function printImgRatingByValue($rating)
    {
        $rating = str_replace(',', '.', $rating);

        if ($rating==5) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/5.png"></span>';
        } elseif($rating>=4.5) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/4,5.png"></span>';
        } elseif($rating>=4) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/4.png"></span>';
        } elseif($rating>=3.5){
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/3,5.png"></span>';
        } elseif($rating>=3) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/3.png"></span>';
        } elseif($rating>=2.5) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/2,5.png"></span>';
        } elseif($rating>=2) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/2.png"></span>';
        } elseif($rating>=1.5) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/1,5.png"></span>';
        } elseif($rating>=1) {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/1.png"></span>';
        } else {
            $i_code = '<span class="star_span def_bg" data-src="/old_theme/img/stars/0,5.png"></span>';
        }

        return $i_code;
    }


    public static function printImgRatingByValueForAMP($rating)
    {
        $rating = str_replace(',', '.', $rating);

        if($rating>=4.8){
            $i_code = '<span class="star_span rating5"></span>';
        }elseif($rating>=4.25){
            $i_code = '<span class="star_span rating4_5"></span>';
        }elseif($rating>=3.75) {
            $i_code = '<span class="star_span rating4"></span>';
        }elseif($rating>=3.25){
            $i_code = '<span class="star_span rating3_5"></span>';
        }elseif($rating>=2.75) {
            $i_code = '<span class="star_span rating3"></span>';
        }elseif($rating>=2.25){
            $i_code = '<span class="star_span rating2_5"></span>';
        }elseif($rating>=1.75){
            $i_code = '<span class="star_span rating2"></span>';
        }elseif($rating>=1.25){
            $i_code = '<span class="star_span rating1_5"></span>';
        }elseif($rating>=0.75){
            $i_code = '<span class="star_span rating1"></span>';
        }else{
            $i_code = '<span class="star_span rating0_5"></span>';
        }

        return $i_code;
    }

    /**
     * @param $rating
     * @return string
     */
    public static function printIRatingByValue($rating)
    {
        $rating = str_replace(',', '.', $rating);

        if ($rating>=4.8) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star"></i>';
        } elseif($rating>=4.25) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-half-o"></i>';
        } elseif($rating>=3.75) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } elseif($rating>=3.25) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-half-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } elseif($rating>=2.75) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } elseif($rating>=2.25) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-half-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } elseif($rating>=1.75) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } elseif($rating>=1.25) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star-half-o"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } elseif($rating>=0.75) {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star-o"></i><i data-value="0" data-item="3" title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        } else {
            $i_code = '<i data-value="0" data-item="1" title="Очень плохо" class="fa fa-star-half-o"></i><i data-value="0" data-item="2" title="Плохо" class="fa fa-star-o"></i><i data-value="0" data-item="3"  title="Средне" class="fa fa-star-o"></i><i data-value="0" data-item="4" title="Хорошо" class="fa fa-star-o"></i><i data-value="0" data-item="5" title="Отлично" class="fa fa-star-o"></i>';
        }

        return $i_code;
    }

}



