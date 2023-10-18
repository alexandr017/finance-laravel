<?php

namespace App\Algorithms\Frontend\Breadcrumbs;

class BreadcrumbsRender
{
    public static function get($breadcrumb, $h1)
    {
        // если пустые ХК - возвращаем название h1
        if($breadcrumb == null) {
            return [
                'h1' => $h1
            ];
        }


        // если ХК однострончые возвращаем их
        if (! strstr($breadcrumb, '@')) {
            return [
                [
                    'h1' => $breadcrumb
                ]
            ];
        }


        // далее идет магия
        // если ХК многострочные - парсим
        $result = [];

        $selector = strstr($breadcrumb, "\r\n") != false
            ? "\r\n"
            : "\n";

        $rowArr = explode($selector, $breadcrumb);


        for ($i = 0; $i < count($rowArr); $i++) {

            // пропускаем пустые строки
            if(empty($rowArr[$i])) continue;

            // парсим строку если есть разделитель
            if (strstr($rowArr[$i], '@')) {
                $line = explode('@',$rowArr[$i]);

                $h1 = trim($line[0]);

                $link = trim($line[1]);
                $link = preg_replace('/^\//','', $link);
                $link = preg_replace('/\/$/','', $link);

                $result [] = [
                    'h1' => $h1,
                    'link' => '/' . $link
                ];

                // если нет разделителя в строке и это последний элемент
            } elseif ($i == count($rowArr)-1) {

                $result [] = [
                    'h1' => trim($rowArr[$i])
                ];

                // если строка не последняя и нет разделителя (не указана ссылка)
                // то что-то не так и хакрываем выполднение метода
            } else {
                return [];
            }
        }

        return $result;
    }


    public static function getForTurbo($alias, $breadcrumb, $h1)
    {
        $domain = 'https://finance.ru';


        // если пустые ХК - возвращаем название h1
        if($breadcrumb == null) {
            return [
                'h1' => $h1
            ];
        }


        // если ХК однострончые возвращаем их
        if (! strstr($breadcrumb, '@')) {
            return [
                [
                    'h1' => $breadcrumb
                ]
            ];
        }


        // далее идет магия
        // если ХК многострочные - парсим
        $result = [];

        $selector = strstr($breadcrumb, "\r\n") != false
            ? "\r\n"
            : "\n";

        $rowArr = explode($selector, $breadcrumb);


        for ($i = 0; $i < count($rowArr); $i++) {

            // пропускаем пустые строки
            if(empty($rowArr[$i])) continue;

            // парсим строку если есть разделитель
            if (strstr($rowArr[$i], '@')) {
                $line = explode('@',$rowArr[$i]);

                $h1 = trim($line[0]);

                $link = trim($line[1]);
                $link = preg_replace('/^\//','', $link);
                $link = preg_replace('/\/$/','', $link);

                $result [] = [
                    'h1' => $h1,
                    'link' => $domain .'/' . $link
                ];

                // если нет разделителя в строке и это последний элемент
            } elseif ($i == count($rowArr)-1) {

                $result [] = [
                    'h1' => trim($rowArr[$i]),
                    'link' => $domain .'/' . $alias
                ];



                // если строка не последняя и нет разделителя (не указана ссылка)
                // то что-то не так и хакрываем выполднение метода
            } else {
                return [];
            }
        }

        return $result;
    }
}
