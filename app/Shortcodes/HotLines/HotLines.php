<?php
namespace App\Shortcodes\HotLines;

use App\Shortcodes\BaseShortcode;

class HotLines extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        $online_credit = $shortcode->online_credit;
        $credit_cards = $shortcode->credit_cards;
        $debit_cards = $shortcode->debit_cards;
        $rko = $shortcode->rko;

        $i = 0;
        if($online_credit != null) $i++;
        if($credit_cards != null) $i++;
        if($debit_cards != null) $i++;
        if($rko != null) $i++;

        switch ($i){
            case 1: $greed = 12; break;
            case 2: $greed = 6; break;
            case 3: $greed = 4; break;
            case 4: $greed = 3; break;
            default: return '';
        }

        if (! isset($this->template)) {
            return;
        }

        if ($this->template == 'amp') {
            return '';
        }

        if(!in_array('hot_lines',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='hot_lines';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/hot_lines/$this->template.blade.php")) {
            return view("short_codes.hot_lines.$this->template",compact('online_credit','credit_cards','debit_cards','rko','greed'));
        }

        return;
    }

}
