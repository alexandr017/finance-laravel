<?php

namespace App\Algorithms;

class AMP
{
    public static function render($html){
    	$html = self::IMG($html);
    	$html = self::scripts($html);
        $html = self::IFRAME($html);
        $html = self::doubleRel($html);
        $html = self::starsReplace($html);
        $html = self::textReplace($html);
    	return $html;
    }

    public static function scripts($html){
        $html = preg_replace('/^<script.{1,}<\/script>$/is', '', $html);
    	return preg_replace('/<script.{1,}<\/script>/is', '', $html);
    }


    public static function IMG($html){
    	return preg_replace_callback('/<img.{1,}"\s?\s?\/?[^<]?>/', ['self','IMG_callback']  ,$html);
    }

    public static function doubleRel($html){
        $html = str_replace('rel="noopener" rel="nofollow"', 'rel="nofollow"', $html);
    	return str_replace('rel="nofollow noopener" rel="nofollow"', 'rel="nofollow"', $html);
    }

    public static function IFRAME($html){
        $html = str_replace('<iframe', '<amp-iframe sandbox="allow-scripts allow-same-origin" layout="responsive"', $html);
        return str_replace('</iframe>', '</amp-iframe>', $html);
    }


    public static function IMG_callback($m){
    	if(isset($m[0])){
    		preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $m[0], $src, PREG_SET_ORDER);
    		preg_match_all('/<img[^>]+alt="?\'?([^"\']+)"?\'?[^>]*>/i', $m[0], $alt, PREG_SET_ORDER);
    		preg_match_all('/<img[^>]+class="?\'?([^"\']+)"?\'?[^>]*>/i', $m[0], $classRow, PREG_SET_ORDER);

    		if(isset($src[0][1])){

                $imgSize = img_size($src[0][1]);
                $width = $imgSize['width'];
                $height = $imgSize['height'];

                $alt = isset($alt[0][1]) ? 'alt="'.$alt[0][1].'"' : '';

                $class = '';
                if (isset($classRow[0])) {
                    if (isset($classRow[0][1])) {
                        $class = $classRow[0][1];
                    }
                }

				if ($width > 300) {
                    return '<div class="img_grey_wrap"><amp-img class="'.$class.'" width="'.$width.'" height="'.$height.'" layout="responsive" src="'.$src[0][1].'"' . $alt. '></amp-img></div>';
                }
				elseif($width == 250) {
                    $class .= ' block-center';
                    return '<amp-img class="'.$class.'" width="'.$width.'" height="'.$height.'" layout="fixed" src="'.$src[0][1].'"' . $alt. '></amp-img>';
                } else   {
                    return '<amp-img class="'.$class.'" width="'.$width.'" height="'.$height.'" layout="fixed" src="'.$src[0][1].'"' . $alt. '></amp-img>';
                }

    		} else {
				$m[0] = str_replace('<img', '<amp-img width="56" height="56" layout="fixed"', $m[0]);
    			$m[0] = str_replace('>', '></amp-img>', $m[0]);
                return $m[0];
    		}

    	}
    }

    public static function starsReplace($html)
    {
        $html = str_replace('<i class="fa fa-star"></i>', '<amp-img alt="Рейтинг" width="15" height="15" layout="fixed" src="/vzo_theme/img/stars/star.png"></amp-img> ', $html);
        $html = str_replace('<i class="fa fa-star-half-o"></i>', '<amp-img alt="Рейтинг" width="15" height="15" layout="fixed" src="/vzo_theme/img/stars/star-half.png"></amp-img> ', $html);
        $html = str_replace('<i class="fa fa-star-o"></i>', '<amp-img alt="Рейтинг" width="15" height="15" layout="fixed" src="/vzo_theme/img/stars/star-empty.png"></amp-img> ', $html);

        return $html;
    }

    public static function textReplace($html)
    {
        $html = preg_replace('/<(h2|div)(.{1,50})?>Динамика популярности .{1,50}<\/(h2|div)>/', '', $html);

        return $html;
    }


}
