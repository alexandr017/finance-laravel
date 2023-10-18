<?php
namespace App\Shortcodes\StructuredFAQ;

class SFAQ {

    public function register($shortcode, $content, $compiler, $name, $viewData=false)
    {
        if ( !isset($GLOBALS['issetStructuredFAQ'])) {
            $GLOBALS['issetStructuredFAQ'] = true;
        }


        if(!in_array('sfaq',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='sfaq';
        }


        $content = str_replace('</li>', '. ', $content);



        if ( !isset($GLOBALS['FAQPage'])) {
            $GLOBALS['FAQPage'] = [];
        }

        if ($shortcode->type == 'question') {

            $em = ($shortcode->em != null)
                ? '&#' . $shortcode->em .';'
                : '';


            $GLOBALS['FAQPage'][] = [
                'name' => $em . ' ' .strip_tags($content),
                'text' => ''
            ];
        }

        if ($shortcode->type == 'answer') {
            if (count($GLOBALS['FAQPage']) == 0) {
                return $GLOBALS['FAQPage'];
            }

            $GLOBALS['FAQPage']
                    [count($GLOBALS['FAQPage']) - 1]
                    ['text']                        = strip_tags($content);
        }

        return $content;


    }

}