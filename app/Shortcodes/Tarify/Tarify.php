<?php
namespace App\Shortcodes\Tarify;

use App\Models\Cards\Cards;
use App\Shortcodes\BaseShortcode;
use Illuminate\Support\Facades\App;

class Tarify extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        return '';
        $tariffCard = null;
        if($shortcode->id == null){
            $img = $shortcode->img;
            $text = $shortcode->text;
            $list = $shortcode->list;

            $listArr = explode(';',$list);
            $listHtml = '<ul>';
            foreach ($listArr as $key => $value) {
                $listHtml = $listHtml . "<li>" . $value .  "</li>";
            }
            $listHtml .= '</ul>';
            $title = $shortcode->title;
        }else{
            $companiesTariffsRepositories = App::make('App\Repositories\Backend\Companies\CompaniesTariffsRepositories');
            $tarif = $companiesTariffsRepositories->getFor($shortcode->id);
            if($tarif->card_id != 0) {
                $tariffCard = Cards::find($tarif->card_id);
            }
            $title = $tarif->title;
            $img = $tarif->img;
            $sum_min = $tarif->sum_min !=0 ? "от " . number_format($tarif->sum_min, 0, '.', ' ') : '';
            $sum_max = $tarif->sum_max !=0 ? "до " . number_format($tarif->sum_max, 0, '.', ' ') : '';
            $term_min = $tarif->term_min !=0 ? "от $tarif->term_min" : '';
            $term_max = $tarif->term_max  !=0? "до $tarif->term_max" : '';
            $text = $tarif->text;

            $listHtml = "<ul>
                <li>Сумма $sum_min $sum_max ₽</li>
                <li>Срок $term_min $term_max дней</li>
                <li>Процентная ставка от $tarif->percent% в день</li>
            </ul>";
        }
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('tarify',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='tarify';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/tarify/$this->template.blade.php")) {
            return view("site.v3.shortcodes.tarify.$this->template",compact('title','img','text','listHtml','tariffCard'));
        }

    }

}