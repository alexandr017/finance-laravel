<?php
namespace App\Shortcodes\Cards;

use App\Shortcodes\BaseShortcode;

class FirstNTitlesCards extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        global $c;

        if(isset($GLOBALS['card_best_on_k5m'])){

            return $GLOBALS['card_best_on_k5m'];

        } else {

            $n = (int) $shortcode->n;

            if (count($c) < $n) {
                return;
            }

            $titles = [];

            for ($i=0; $i<$n; $i++) {
                if (isset($c[$i])) {
                    $titles [] = ' «' . $c[$i]->title . '»';
                }

            }

            return implode(',' , $titles);

        }

        return;
    }

}