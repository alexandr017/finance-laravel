<?php
namespace App\Shortcodes\Forms;
use App\Shortcodes\BaseShortcode;
use Auth;
use Form;
use Session;

class AuthForm extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
    	if(Auth::id() == null){
            if(Session::has('errors')){
                $session = "<p class=\"alert alert-danger\">Неверный Email или пароль.</p>";
            } else {
                $session = '';
            }

            if(Session::has('form_error1')){
                $form_error = Session::get('form_error1');
                Session::forget('form_error1');
                if(isset($form_error))
                    $session = "<script type=\"text/javascript\">alert(\"Вы не прошли проверку Captcha\");location.reload();</script>";
            }
            if (! isset($this->template)) {
                return;
            }
            // pc, mob, turbo, amp
            if (file_exists(resource_path() . "/views/site/v3/shortcodes/forms/auth_form/$this->template.blade.php")) {
                return view("site.v3.shortcodes.forms.auth_form.$this->template", compact('session'));
            }

            return;
    	} else {
    		return '<p><b>Вы уже авторизованы. Перейти в <a href="/dashboard">личный кабинет</a>.</b></p>';
    	}

    }

}
