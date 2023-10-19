<?php
namespace App\Shortcodes\Comparison;

use App\Shortcodes\BaseShortcode;

class Comparison extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
      	$title = $shortcode->title;
      	$img1 = $shortcode->img1;
      	$alt1 = $shortcode->alt1;
      	$img2 = $shortcode->img2;
      	$alt2 = $shortcode->alt2;
      	$img3 = $shortcode->img2;
      	$alt3 = $shortcode->alt3;
      	$count = count($GLOBALS['_comparison']);

      	$t0 = (isset($GLOBALS['_comparison'][0]['title'])) ? $GLOBALS['_comparison'][0]['title'] : '';
      	$t1 = (isset($GLOBALS['_comparison'][1]['title'])) ? $GLOBALS['_comparison'][1]['title'] : '';
      	$t2 = (isset($GLOBALS['_comparison'][2]['title'])) ? $GLOBALS['_comparison'][2]['title'] : '';
      	$content0 = (isset($GLOBALS['_comparison'][0]['content'])) ? $GLOBALS['_comparison'][0]['content'] : '';
      	$content1 = (isset($GLOBALS['_comparison'][1]['content'])) ? $GLOBALS['_comparison'][1]['content'] : '';
      	$content2 = (isset($GLOBALS['_comparison'][2]['content'])) ? $GLOBALS['_comparison'][2]['content'] : '';

#dd($GLOBALS['_comparison'][0]['content']);

        $GLOBALS['_comparison'] = null;

      	if($count == null) return;
        if (! isset($this->template)) {
            return;
        }
        if(!in_array('comparison',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='comparison';
        }
        //ddd($GLOBALS['short_code_css']);
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/comparison/$this->template.blade.php")) {
            return view("site.v3.shortcodes.comparison.$this->template", compact('count','title','img1','alt1','t0','content0','img2','alt2','t1','content1','t2','content2'));
        }

        return;

      	}

}