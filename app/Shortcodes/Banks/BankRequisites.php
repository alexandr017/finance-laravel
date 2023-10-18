<?php
namespace App\Shortcodes\Banks;

use App\Models\Banks\Bank;
use App\Shortcodes\BaseShortcode;


class BankRequisites extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

        $BankID =  (int) $shortcode->id ?? null;

        if ($BankID == 0) {
            return '';
        }

        $bank = Bank::find($BankID);

        if ($bank == null) {
            return '';
        }

        if (file_exists(resource_path() . "/views/short_codes/banks/bank_requisites/$this->template.blade.php")) {
            return view("short_codes.banks.bank_requisites.$this->template", compact('bank'));
        }

        return '';
    }

}