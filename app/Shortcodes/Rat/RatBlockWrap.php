<?php
namespace App\Shortcodes\Rat;

use App\Shortcodes\BaseShortcode;

class RatBlockWrap extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
  	    //$content = do_shortcode($content);
	    $pros_titles = '';
	    $cons_titles = '';
	    $pros_descs = '';
	    $cons_descs = '';
	    $content = str_replace('<p>', '', $content);
	    $content = str_replace('</p>', '', $content);
	    if(isset($GLOBALS['pros'])){
	    if($GLOBALS['pros'] != null){
	    foreach ($GLOBALS['pros'] as $key => $value) {
	        $pros_titles = $pros_titles . "<li>" . $value['title']. "</li>\n";
	        $pros_descs = $pros_descs . "<li>" . $value['title']. "<div>".$value['content']."</div></li>\n";
	    }
	    }
	    }

	    if(isset($GLOBALS['cons'])){
	    if($GLOBALS['cons'] != null){
	    foreach ($GLOBALS['cons'] as $key => $value) {
	        $cons_titles = $cons_titles . "<li>" . $value['title']. "</li>\n";
	        $cons_descs = $cons_descs . "<li>" . $value['title']. "<div>".$value['content']."</div></li>\n";
	    }
	    }
	    }

	    unset($GLOBALS['pros']);
	    unset($GLOBALS['cons']);
	   

        if (! isset($this->template)) {
            return;
        }
        if(!in_array('rat',$GLOBALS['short_code_css'])){
            $GLOBALS['short_code_css'][]='rat';
        }
        // pc, mob, turbo, amp
        if (file_exists(resource_path() . "/views/site/v3/shortcodes/rat/rat_block_wrap/$this->template.blade.php")) {
            return view("site.v3.shortcodes.rat.rat_block_wrap.$this->template",compact('pros_titles','cons_titles','pros_descs','content','cons_descs'));
        }

        return;
	}
  
}