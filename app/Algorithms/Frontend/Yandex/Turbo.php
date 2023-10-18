<?php

namespace App\Algorithms\Frontend\Yandex;

class Turbo {

    /**
     * @param string $content
     * @return string $content
     */
    public static function render($content)
    {
        //$text_before = preg_replace('/\[.{1,}\]/', '', $post->content);
        $content = str_replace('<p></p>', '', $content);
        $content = str_replace("&laquo;", '"', $content);
        $content = str_replace("&raquo;", '"', $content);
        $content = str_replace("&mdash;", '—', $content);
        $content = str_replace("&ndash;", '', $content);
        $content = str_replace("&nbsp;", '', $content);
        $content = str_replace("&ldquo;", '"', $content);
        $content = str_replace("&oacute;", 'О', $content);

        $content = str_replace("&rdquo;", '"', $content);
        $content = str_replace("&times;", ' ', $content);
        $content = str_replace("&middot;", '·', $content);
        $content = str_replace("&rsquo;", '’', $content);
        $content = str_replace("&gt;", '>', $content);
        $content = str_replace("&lt;", '<', $content);
        $content = str_replace("&amp;", '&', $content);
        $content = str_replace("&quot;", '"', $content);
        //$content = str_replace("<div", ' <div', $content);
        //$content = str_replace("div", 'i', $content);


        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);



        //$content = AMP::render($content);
        //$content = str_replace("<p><br /></p>", '', $content);
        //$content = str_replace("amp-img", 'img', $content);
        //$PCREpattern = '/\r\n|\r|\n/u';
        $PCREpattern = '/\r\n/u';
        $content = preg_replace($PCREpattern, '', $content);        
        
        return $content;
    }

}
