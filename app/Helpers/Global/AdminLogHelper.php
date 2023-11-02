<?php

if (! function_exists('adminLog')) {
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
            'user_id' => $userID ?? 1, // TODO: временно
            'details' => $details,
            'action_id' => $actionID
        ]);

        return null;
    }
}