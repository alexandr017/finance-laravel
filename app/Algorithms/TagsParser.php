<?php

namespace App\Algorithms;

use App\Algorithms\Frontend\Content\CreateSidebarMenu;

class TagsParser {

    /**
     * @param $content
     * @return mixed
     */
    public static function compile($content){
        $content = self::setNofollowForLinks($content);
        $content = self::setlazyLoadingForImages($content);
        //$content = self::setlazyLoadingForIframes($content);
        $content = self::removeEmptyP($content);
        $content = CreateSidebarMenu::render($content);
        return $content;
    }


    /**
     * @param $content
     * @return mixed
     */
    public static function render($content){
        $content = self::setNofollowForLinks($content);
        $content = self::removeEmptyP($content);
        return $content;
    }


    /**
     * @param $content
     * @return mixed|null|string|string[]
     */
    public static function setNofollowForLinks($content){

        $content = str_replace('rel="noopener nofollow"','',$content);
        $content = str_replace('rel="noopener"','',$content);

        $regExpression = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";

        if(preg_match_all("/$regExpression/siU", $content, $matches, PREG_SET_ORDER)) {
            if( !empty($matches) ) {

                $targetUrl = 'https://finance.ru';
                for ($i=0; $i < count($matches); $i++)
                {

                    $tag = $matches[$i][0];
                    $tag2 = $matches[$i][0];
                    $url = $matches[$i][0];

                    if(isset($matches[$i][2])){
                        if(isset($matches[$i][2][0])){
                            if($matches[$i][2][0] == '#')
                                continue;
                        }
                    }

                    $noFollow = '';

                    $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if( count($match) < 1 )
                        $noFollow .= ' target="_blank" ';

                    $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if( count($match) < 1 )
                        $noFollow .= ' rel="nofollow" ';

                    $pos = strpos($url,$targetUrl);
                    $relative = preg_match("/href=('|\")\/[^\/]/i", $url);
                    #dd(strpos($url,$targetUrl));
                    if (($pos === false) && ($relative == false)) {
                        $tag = rtrim ($tag,'>');
                        $tag .= $noFollow.'>';
                        $content = str_replace($tag2,$tag,$content);
                    }
                }
            }
        }

        $content = preg_replace_callback(
            '/<a href="https:\/\/vsezaimyonline\.ru\/[a-zA-z0-9_\/-]{1,}" target="_blank" rel="noopener nofollow">/m',
            function($reg){
                if(isset($reg[0]))
                    return str_replace(' rel="noopener nofollow"','',$reg[0]);
                else return;
            },
            $content
        );

        $content = preg_replace('/"\s>/siU','">',$content);

        return $content;

    }


    /**
     * @param $content
     * @return mixed
     */
    /*
     public static function setlazyLoadingForImages($content){
        if (strstr(\Request::url(), 'vsezaimyonline.ru/debit-cards')) {
        return str_replace('<img ', '<img loading="lazy" ', $content);
        }

        $regExpression = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";

        if(preg_match_all("/$regExpression/siU", $content, $matches, PREG_SET_ORDER)) {
            if( !empty($matches) ) {

                for ($i=0; $i < count($matches); $i++) {

                    $tag = $matches[$i][0];

                    $replacedStr = $tag;
                    $issetClass = false;
                    if (strstr($tag, "class='")){
                        $issetClass = true;
                        $replacedStr = str_replace("class='", "class='def_load ", $tag);
                    }

                    if (strstr($tag, 'class="')) {
                        $issetClass = true;
                        $replacedStr = str_replace('class="', 'class="def_load ', $tag);
                    }

                    if(!$issetClass){
                        $replacedStr = str_replace('<img ', '<img class="def_load" ', $replacedStr);
                    }

                    $replacedStr = str_replace('src=', ' src="/old_theme/img/lazy-loading.jpg" data-src=', $replacedStr);
                    $content = str_replace($tag, $replacedStr, $content);

                }

            }
        }

        return $content;
        }
     * */
    public static function setlazyLoadingForImages($content){
        //return $content;
        /*
        return preg_replace_callback('/<img.{1,}"\s?\s?\/?[^<]?>/', ['self','IMG_callback']  ,$content);
        */
        return preg_replace_callback('/<img[^>]{1,}>/', ['self','IMG_callback']  ,$content);
    }





    public static function IMG_callback($m)
    {
        if(isset($m[0])){
            preg_match_all('/<img[^>]+src="?\'?([^"\']+)"?\'?[^>]*>/i', $m[0], $src, PREG_SET_ORDER);
            preg_match_all('/<img[^>]+alt="?\'?([^"\']+)"?\'?[^>]*>/i', $m[0], $alt, PREG_SET_ORDER);
            preg_match_all('/<img[^>]+class="?\'?([^"\']+)"?\'?[^>]*>/i', $m[0], $class, PREG_SET_ORDER);

            if(isset($src[0][1])){
                $file_name = str_replace('https://finance.ru/', '', $src[0][1]);
                if(file_exists(public_path().'/'.$file_name)){
                    $img = getimagesize(public_path().'/'.$file_name);
                    $width = isset($img[0]) ? $img[0] : 56 ;
                } else {
                    $width = 56;
                }
                $class_attr = isset($class[0][1]) ? $class[0][1] : '';
                $class_attr = $width > 300
                    ? $class_attr . ' loading_lazy'
                    : $class_attr . '';
                $alt_attr = isset($alt[0][1]) ? $alt[0][1] : '';

                $src_attr = $src[0][1];
                $src_attr = str_replace("https://finance.ru", '', $src_attr);
                $src_attr = str_replace("//vsezaimyonline.ru", '', $src_attr);

                //ddd($src[0][1]);

                return '<img loading="lazy" class="'. $class_attr .'" src="'. $src_attr .'" alt="'. $alt_attr .'">';

            } else {
                $m[0] = str_replace('<img', '<img loading="lazy"', $m[0]);
                return $m[0];
            }

        }
    }


    /**
     * @param $content
     * @return mixed
     */
    public static function setlazyLoadingForIframes($content){
        $regExpression = "<iframe\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";

        if(preg_match_all("/$regExpression/siU", $content, $matches, PREG_SET_ORDER)) {
            if( !empty($matches) ) {

                for ($i=0; $i < count($matches); $i++) {

                    $tag = $matches[$i][0];

                    $replacedStr = $tag;
                    $issetClass = false;
                    if (strstr($tag, "class='")){
                        $issetClass = true;
                        $replacedStr = str_replace("class='", "class='def_load_frame ", $tag);
                    }

                    if (strstr($tag, 'class="')) {
                        $issetClass = true;
                        $replacedStr = str_replace('class="', 'class="def_load_frame ', $tag);
                    }

                    if(!$issetClass){
                        $replacedStr = str_replace('<iframe ', '<iframe class="def_load_frame"', $replacedStr);
                    }

                    $replacedStr = str_replace('src=', 'src="/old_theme/img/lazy-loading.jpg" data-src=', $replacedStr);
                    $content = str_replace($tag, $replacedStr, $content);

                }

            }
        }

        return $content;
    }

    /**
     * @param $content
     * @return mixed|null|string|string[]
     */
    public static function removeEmptyP($content)
    {
        $content = str_replace("<p></p>",'',$content);
        $content = str_replace("<p> </p>",'',$content);
        $content = preg_replace("/<p>\s{0,}\n\s{0,}<\/p>/um",'',$content);

        return $content;
    }
}


