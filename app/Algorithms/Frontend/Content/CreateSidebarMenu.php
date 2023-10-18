<?php

namespace App\Algorithms\Frontend\Content;

class CreateSidebarMenu
{
    /**
     * @param $content
     * @return mixed
     */
    public static function render($content)
    {
        global $sidebar_tags_menu;
        $menu = [];

        preg_match_all( '#<h[1-6](.*?)>(.*?)</h[1-6]>#', $content, $matches );

        foreach ($matches[0] as $key => $match) {
            $current_tag_key = (int) str_replace('<h','',$match);
            $current_tag_value = (isset($matches[2][$key])) ? ($matches[2][$key]) : '';

            $id = '';
            if(isset($matches[1][$key])) {
                if (strstr($matches[1][$key], 'id')) {
                    preg_match_all( '#id=[\'\"][a-zA-Z0-9_\s]{1,}[\'\"]#', trim($matches[1][$key]), $matches_id );
                    if(isset($matches_id[0][0])) {
                        $id = str_replace('id=','',$matches_id[0][0]);
                        $id = str_replace('"','',$id);
                        $id = str_replace("'",'',$id);
                    }

                } else {
                    $id = rand(50,5000);
                    $content = str_replace(
                        $match,
                        str_replace('<h'.$current_tag_key, '<h' . $current_tag_key . ' id="'.$id.'"', $match),
                        $content
                    );
                }
            } else {
                $id = rand(50,5000);
                $content = str_replace(
                    $match,
                    str_replace('<h'.$current_tag_key, '<h' . $current_tag_key . ' id="'.$id.'"', $match),
                    $content
                );
            }

            if (count($menu) != 0) {

                if ($menu[count($menu) -1]['h_tag'] < $current_tag_key) {
                    $menu[count($menu) -1]['child'] [] = [
                        'h_tag' => $current_tag_key,
                        'text' => $current_tag_value,
                        'id' => $id,
                        'child' => []
                    ];
                } else {
                    $menu [] = [
                        'h_tag' => $current_tag_key,
                        'text' => $current_tag_value,
                        'id' => $id,
                        'child' => []
                    ];
                }

            } else {
                $menu [] = [
                    'h_tag' => $current_tag_key,
                    'text' => $current_tag_value,
                    'id' => $id,
                    'child' => []
                ];
            }

        }

        foreach ($menu as $key => $item) {
            $text = $item['text'];
            for($i = 0; $i<=15; $i++) {
                $text = str_replace("$i место.", '', $text);
            }
            $menu[$key]['text'] = $text;
            /*
            $menu[$key]['text'] = str_replace("место", '', $item['text']);
            $menu[$key]['text'] = str_replace("место", '', $item['text']);
            $menu[$key]['text'] = str_replace("место", '', $item['text']);
            $menu[$key]['text'] = str_replace("3 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("4 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("5 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("6 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("7 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("8 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("9 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("10 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("11 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("12 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("13 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("14 место.", '', $item['text']);
            $menu[$key]['text'] = str_replace("15 место.", '', $item['text']);
            */

        }

        $sidebar_tags_menu = $menu;
        return $content;
    }
}