<?php


use App\Algorithms\System;
use App\Models\Users\Users;

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


if (! function_exists('img_size')) {
    /**
     * @param  string img
     * @param  int width
     * @param  int height
     * @return array
     */
    function img_size($img, $width = 100, $height = 100)
    {
        $img = str_replace('https://vsezaimyonline.ru/', '', $img);
        if (file_exists(public_path().'/'.$img)) {
            $data = getimagesize(public_path() .'/'. $img);
            $width = $data[0];
            $height = $data[1];
        }

        return [
            'width' => $width,
            'height' => $height
        ];
    }
}



function getIdUserCompanies() {

    global $idUserCompanies;

    if ($idUserCompanies == null) {

        $userIds = \Cache::rememberForever('id_user_companies', function(){
            return Users::where('company_id', '!=', null)
                ->select('id', 'company_id')
                ->get()
                ->pluck('company_id', 'id')
                ->toArray();
        });

        $idUserCompanies = $userIds;
    }

    return $idUserCompanies;

}


/**
 * @param $entity string
 * @param $entityID int
 * @param $actionType string
 * @param $details string | null
 * @return null
 */
function adminLog($entity, $entityID, $actionType, $details = null)
{
    $userID = \Auth::id();

    $entityType = 'undefined type';
    switch ($entity) {
        case 'Анализ офферов' : $entityType = 1; break;
        case 'Партнерская программа' : $entityType = 2; break;
        case 'Блок "мы сравниваем, вы экономите"' : $entityType = 3; break;
        case 'Карточки' : $entityType = 4; break;
        case 'Преимущества на разделах листингов' : $entityType = 5; break;
        case 'Категория карточек' : $entityType = 6; break;
        case 'Листинги (старые)' : $entityType = 7; break;
        case 'Жалобы' : $entityType = 8; break;
        case 'Привязка карточек к листингу' : $entityType = 9; break;
        case 'Пользователи' : $entityType = 10; break;
        case 'Трансляции' : $entityType = 11; break;
        case 'Посты трансляций' : $entityType = 12; break;
        case 'Способы выплаты' : $entityType = 13; break;
        case 'Листинги' : $entityType = 14; break;
        case 'QA-вопросы' : $entityType = 15; break;
        case 'QA-ответы' : $entityType = 16; break;
        case 'QA-теги' : $entityType = 17; break;
        case 'Авторы' : $entityType = 18; break;
        case 'Избранные обзоры' : $entityType = 19; break;
        case 'Рубрики записей' : $entityType = 20; break;
        case 'Комментарии' : $entityType = 21; break;
        case 'Записи' : $entityType = 22; break;
        case 'Обзоры продуктов' : $entityType = 23; break;
        case 'Страницы' : $entityType = 24; break;
        case 'Настройки главной' : $entityType = 25; break;
        case 'Настройки словаря' : $entityType = 26; break;
        case 'Очистка кэша (полная)' : $entityType = 27; break;
        case 'Очистка кэша карточек' : $entityType = 28; break;
        case 'Ручная RSS-лента' : $entityType = 29; break;
        case 'Ручная очистка данных юзеров (старше 2ух месяцев)' : $entityType = 30; break;
        case 'Меню' : $entityType = 31; break;
        case 'Заявки представителей компаний' : $entityType = 32; break;
        case 'Инфо-страницы от представителей компаний' : $entityType = 33; break;
        case 'Новости от представителей компаний' : $entityType = 34; break;
        case 'Отзывы от представителей компаний' : $entityType = 35; break;
        case 'Жалобы от представителей компаний' : $entityType = 36; break;
        case 'Категории страховок' : $entityType = 37; break;
        case 'Документы страховок' : $entityType = 38; break;
        case 'FAQ страховок' : $entityType = 39; break;
        case 'Главная страховок' : $entityType = 40; break;
        case 'Карточки страховок' : $entityType = 41; break;
        case 'Листинги (страховок)' : $entityType = 42; break;
        case 'Отзывы страховок' : $entityType = 43; break;
        case 'Группы фильтров страховок' : $entityType = 44; break;
        case 'Скрытые ссылки' : $entityType = 45; break;
        case 'Форма рекламное сотрудничество' : $entityType = 46; break;
        case 'Форма добавить организацию' : $entityType = 47; break;
        case 'Форма как установить виждет' : $entityType = 48; break;
        case 'Эксперты' : $entityType = 49; break;
        case 'Словарь' : $entityType = 50; break;
        case 'Компании и инфо-страницы' : $entityType = 51; break;
        case 'Компании и инфо-страницы (только инфо страницы)' : $entityType = 52; break;
        case 'Выходные дни компаний' : $entityType = 53; break;
        case 'Отзывы компаний' : $entityType = 54; break;
        case 'Тарифы компаний' : $entityType = 55; break;
        case 'Города' : $entityType = 56; break;
        case 'Страницы банкоматов в городах' : $entityType = 57; break;
        case 'Страницы банкоматов' : $entityType = 58; break;
        case 'Страницы отделений в городах' : $entityType = 59; break;
        case 'Страницы отделений' : $entityType = 60; break;
        case 'Категорийные страницы банков' : $entityType = 61; break;
        case 'Страницы отзывов категорийных страниц банка' : $entityType = 62; break;
        case 'Главная банков' : $entityType = 63; break;
        case 'Продукты банков' : $entityType = 64; break;
        case 'Страницы отзывов продуктов банков' : $entityType = 65; break;
        case 'Отзывы банков' : $entityType = 66; break;
        case 'Банки' : $entityType = 67; break;
        case 'Инфо-страницы банков' : $entityType = 68; break;
        case 'Смена лого сайта' : $entityType = 69; break;
        case 'Сео тексты для страниц' : $entityType = 70; break;
        case 'Теги записей' : $entityType = 71; break;

    }




    $actionID = 0;
    switch ($actionType) {
        case 'create' : $actionID = 1; break;
        case 'update' : $actionID = 2; break;
        case 'delete' : $actionID = 3; break;
    }

    \DB::table('admin_logs')->insert([
        'entity_type' => $entityType,
        'entity_id' => $entityID,
        'user_id' => $userID,
        'details' => $details,
        'action_id' => $actionID
    ]);

    return null;
}



if (! function_exists('empty_str_to_null')) {
    /**
     *
     * @return mixed
     */
    function empty_str_to_null($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if($value == '') {
                    $data[$key] = null;
                }
            }

        } elseif (gettype($data) == 'string') {
            if ($data == '') {
                $data = null;
            }
        }

        return $data;
    }
}