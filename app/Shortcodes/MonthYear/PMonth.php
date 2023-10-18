<?php
namespace App\Shortcodes\MonthYear;

use App\Shortcodes\BaseShortcode;

class PMonth extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        switch (date('n')) {
            case 1: return 'Январе';
            case 2: return 'Феврале';
            case 3: return 'Марте';
            case 4: return 'Апреле';
            case 5: return 'Мае';
            case 6: return 'Июне';
            case 7: return 'Июле';
            case 8: return 'Августе';
            case 9: return 'Сентябре';
            case 10: return 'Октябре';
            case 11: return 'Ноябре';
            case 12: return 'Декабре';
            default: '';
        }


    }

}