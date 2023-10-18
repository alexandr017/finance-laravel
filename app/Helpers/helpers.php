<?php


use App\Models\System;

if (!function_exists('fake_update_offer')) {
    /**
     * @param date $date
     * @return string
     */
    function fake_update_offer($date)
    {
        $d = date('d', strtotime($date));

        $m = ($d > date('d')) ? ((int)date('m')) : date('m');

        $Y = date('Y');

        if ($d > date('d')) {
            $m--;
        }

        if ($m == 0) {
            $Y--;
            $m = 12;
        }

        if ($m < 10) {
            $m = '0' . $m;
        }

        if (($d > 28) && ($m == 2)) {
            $d = '27';
        }
        if (strstr($m, '00')) {
            $m = str_replace('00', '0', $m);
        }

        return $d . '.' . $m . '.' . $Y;
    }
}



if (! function_exists('is_mobile_device')) {
    /**
     *
     * @return boolean
     */
    function is_mobile_device()
    {
        $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        foreach ($mobile_agent_array as $value) {
            if (strpos($agent, $value) !== false) return true;
        }
        return false;
    }
}


if (!function_exists('compress_css')) {
    /**
     * @param string $s
     * @return string
     */
    function compress_css($s)
    {
        $s = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $s);
        $s = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $s);
        return $s;
    }
}


if (!function_exists('is_amp_page')) {
    /**
     *
     * @return boolean
     */
    function is_amp_page()
    {
        $current_url = $_SERVER['REQUEST_URI'];

        if (preg_match('/\/amp\/page$/', $current_url) || preg_match('/\/amp$/', $current_url)) {
            return true;
        }

        return false;
    }
}


if (!function_exists('is_turbo_page')) {
    /**
     *
     * @return boolean
     */
    function is_turbo_page()
    {
        $current_url = $_SERVER['REQUEST_URI'];

        if (preg_match('/\/yandex\/turbo\//', $current_url)) {
            return true;
        }

        return false;
    }
}


if (! function_exists('clear_data')) {
    /**
     * Функция очищает код от возможных иньекций и взломов
     *
     * @param $data
     * @return mixed
     */
    function clear_data($data)
    {
        $hackBlackList = ['--', 'drop', ';', '#', '/*', '*/', 'version()', 'concat', 'extract'];

        foreach ($hackBlackList as $term) {
            if (strstr($data, $term)) {
                return '';
            }
        }

        return addslashes(stripslashes(htmlspecialchars(strip_tags($data))));
    }
}



function reviewsShortLenghtRender($str)
{

    if (mb_strlen($str, 'UTF-8') > 200) {
        $offset = 170;

        if ($str[$offset] != ' ') {
            while ($str[$offset] != ' ') {
                $offset++;
            }
        }

        $part1 = substr($str, 0, $offset);
        $part2 = substr($str, $offset);

        $part1 = $part1 . '<span class="three_dots">...</span> <span class="show_the_reviews"><i class="fa fa-angle-down"></i> Показать весь отзыв</span><span class="hidden_area_review">';
        $str = $part1 . $part2 . "</span>";
    }

    return $str;
}


function word_by_count($num, $words)
{
    $num = $num % 100;

    if ($num > 19) {
        $num = $num % 10;
    }

    switch ($num) {
        case 1: {
            return($words[0]);
        }
        case 2: case 3: case 4: {
        return($words[1]);
    }
        default: {
            return($words[2]);
        }
    }
};



function cardHeader1($header_1,$category_id) {
    switch ($category_id) {
        case '1': return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
            break;
        case '2':
            # code...
            break;
        case '3':
            # code...
            break;
        case '4': return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
            break;
        case '5':
            # code...
            break;
        case '6':
            # code...
            break;
        case '7': return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
            break;
        case '8':
            return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
            break;
        case '10':
            return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
            break;
        default: return $header_1;
    }
}


function cardHeader2($header_2,$category_id) {
    switch ($category_id) {
        case '1':
            return $header_2  . System::endWords($header_2,[' день',' дня',' дней']) ;
            break;
        case '2':
            # code...
            break;
        case '3':
            # code...
            break;
        case '4': return $header_2  . System::endWords($header_2,[' месяц',' месяца',' месяцев']);
            # code...
            break;
        case '5':
            # code...
            break;
        case '6':
            # code...
            break;
        case '7':
            return $header_2  . System::endWords($header_2,[' день',' дня',' дней']) ;
            break;
        case '8':
            return $header_2  . System::endWords($header_2,[' месяц',' месяца',' месяцев']);
            break;
        case '10':
            return $header_2  . System::endWords($header_2,[' год',' года',' лет']);
            break;
        default: return $header_2;
    }
}


function cardHeader3($header_3,$category_id) {
    switch ($category_id) {
        case '1': return $header_3  . '% в день';
            # code...
            break;
        case '2':
            # code...
            break;
        case '3':
            # code...
            break;
        case '4': return $header_3  . '% в год';
            # code...
            break;
        case '5':
            # code...
            break;
        case '6':
            # code...
            break;
        case '7': return $header_3  . '% в неделю';
            # code...
            break;
        case '8':
            return $header_3  . '% в год';
            break;
        case '10':
            return $header_3  . '% в год';
            break;
        default: return $header_3;
    }
}