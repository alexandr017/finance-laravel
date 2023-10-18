<?php
namespace App\Shortcodes\Expert;

use App\Shortcodes\BaseShortcode;
use App\Models\Expert\Expert as Model;

class Expert extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        $expert_id = $shortcode->id;
        if ($expert_id == null) {
            return;
        }

        $expert = Model::find($expert_id);
        if($expert == null) {
            return;
        }

        $GLOBALS['shortcodes']['experts'][$expert->id] = $expert;

        if (! isset($this->template)) {
            return;
        }


        if(!in_array('expert',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='expert';
        }


                // часть из шорткода микроразметки
                if ( !isset($GLOBALS['issetStructuredFAQ'])) {
                    $GLOBALS['issetStructuredFAQ'] = true;
                }

                if ( !isset($GLOBALS['FAQPage'])) {
                    $GLOBALS['FAQPage'] = [];
                }

                $contentForFAQ = str_replace('</', '. </', $content);
                $contentForFAQ = strip_tags($contentForFAQ);
                $contentForFAQ = str_replace('..', '.', $contentForFAQ);
                $contentForFAQ = str_replace(':.', '.', $contentForFAQ);
                $contentForFAQ = str_replace('. .', '.', $contentForFAQ);


        $GLOBALS['FAQPage'][] = [
                    'name' =>  '&#11088;' . ' Экспертное мнение',
                    'text' => $contentForFAQ
                ];
                // конец

        if (file_exists(resource_path() . "/views/short_codes/expert/expert/$this->template.blade.php")) {

            return view("short_codes.expert.expert.$this->template",compact('expert','content'));
        }


        return;

    }


}