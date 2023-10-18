<?php
namespace App\Shortcodes\OverpaymentTable;
use App\Shortcodes\BaseShortcode;
use Auth;
use Form;
use Session;

class OverpaymentTable extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        $URL = $_SERVER['REQUEST_URI'];
        if (preg_match('/\/amp\/?$/', $URL)) {
            return;
        }


            global $c;


            if(isset($c[0])){

                $min_sum = $c[0]->sum_min;
                $max_sum = $c[0]->sum_max;

                if (isset($c[0]->percent)) {
                    $percent = $c[0]->percent;
                } elseif (isset($c[0]->percent_min)) {
                    $percent = $c[0]->percent_min;
                } else {
                    $percent = 'Не определено';
                }


                if($min_sum == null || $min_sum == '') return;
                if($max_sum == null || $max_sum == '') return;
                if($percent === null || $percent === '') return;

                $overpayment = 0;
                if (! isset($this->template)) {
                    return;
                }
                if(!in_array('overpayment_table',$GLOBALS['short_code_css'])){
                    $GLOBALS['short_code_css'][]='overpayment_table';
                }
                // pc, mob, turbo, amp
                if (file_exists(resource_path() . "/views/short_codes/overpayment_table/$this->template.blade.php")) {
                    return view("short_codes.overpayment_table.$this->template",compact('min_sum','max_sum','percent'));
                }

                return;

            }


        return;

    }

}
