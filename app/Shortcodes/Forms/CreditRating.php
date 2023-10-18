<?php
namespace App\Shortcodes\Forms;
use App\Shortcodes\BaseShortcode;
use Session;
use Auth;

class CreditRating extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){

    	$last_name = old('last_name');
    	$first_name = old('first_name');
    	$middle_name = old('middle_name');
    	$passport = old('passport');
    	$birthday = old('birthday');
    	$passport_date = old('passport_date');
    	$email = old('email');

    	$form_error = (Session::has('form_error')) ? '<div class="alert alert-danger">' . Session::get('form_error') . '</div>' : '';

    	$form_info = (Session::has('form_info')) ? '<div class="alert alert-info">' . Session::get('form_info') . '</div>' : '';

    	Session::forget('form_error');

    	if(Auth::id() != null) return '';

        if (! isset($this->template)) {
            return;
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/short_codes/forms/credit_rating/$this->template.blade.php")) {
            return view("short_codes.forms.credit_rating.$this->template",compact('last_name','first_name','middle_name','passport','birthday','passport_date',
                'passport_date','email','form_error','form_info'));
        }

        return;
    }

}