<?php
namespace App\Shortcodes\YaRTB;

use App\Shortcodes\BaseShortcode;

class YaRTB extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData=false){
        return '';

        if (! isset($this->template)) {
            return;
        }

        // на амп и турбо решили выпилить этот шорткод
        if ($this->template == 'turbo') {
            return '<figure data-turbo-ad-id="footer_ad_place"></figure>';
        }

      	$height = $shortcode->height;
      	$width = $shortcode->width;
	    $height .= 'px';
    	if(!strstr($width,'%')) $width .= 'px';

    	$randID = rand(1,100000);
    	/*
		return '<div id="yandex_rtb_R-A-195312-5" style="margin: auto;width:'.$width.';height:'.$height.';"></div>
		<script type="text/javascript">
		    (function(w, d, n, s, t) {
		        w[n] = w[n] || [];
		        w[n].push(function() {
		            Ya.Context.AdvManager.render({
		                blockId: "R-A-195312-5",
		                renderTo: "yandex_rtb_R-A-195312-5",
		                async: true
		            });
		        });
		        t = d.getElementsByTagName("script")[0];
		        s = d.createElement("script");
		        s.type = "text/javascript";
		        s.src = "//an.yandex.ru/system/context.js";
		        s.async = true;
		        t.parentNode.insertBefore(s, t);
		    })(this, this.document, "yandexContextAsyncCallbacks");
		</script>';
		*/

    	return '<!-- Yandex.RTB R-A-195312-8 -->
<div id="yandex_rtb_R-A-195312-'.$randID.'"></div>
<script>
    (function(w, d, n, s, t) {
        w[n] = w[n] || [];
        w[n].push(function() {
            Ya.Context.AdvManager.render({
                blockId: "R-A-195312-8",
                renderTo: "yandex_rtb_R-A-195312-'.$randID.'",
                async: true
            });
        });
        t = d.getElementsByTagName("script")[0];
        s = d.createElement("script");
        s.type = "text/javascript";
        s.src = "//an.yandex.ru/system/context.js";
        s.async = true;
        t.parentNode.insertBefore(s, t);
    })(this, this.document, "yandexContextAsyncCallbacks");
</script>';


	}


	// [ya_RTB] -  100%x120
	// [ya_RTB height="180"] 
	// [ya_RTB height="180" width="500"]
	// [ya_RTB width="500"]
  
}