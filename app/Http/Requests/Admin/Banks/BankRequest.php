<?php

namespace App\Http\Requests\Admin\Banks;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'alias' => 'required|max:255',

            'name' => 'required|max:255',
            'full_name' => 'required|max:255',
            'logo' => 'required|max:255',
            'og_img' => 'nullable|max:50',
            'title' => 'required|max:255',
            'meta_description' => 'required',
            'h1' => 'required|max:255',
            'breadcrumb' => 'nullable|max:500',
            'lead' => 'nullable',
            'content' => 'nullable',

            'licence' => 'nullable|max:255',
            'phones' => 'nullable|max:255',
            'bik' => 'nullable|max:255',
            'account' => 'nullable|max:255',
            'address_index' => 'nullable|max:255',
            'city_id' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'okato' => 'nullable|max:255',
            'date_opened' => 'nullable|date',
            'swift' => 'nullable|max:255',
            'site' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
            'ogrn' => 'nullable|max:255',
            'okpo' => 'nullable|max:255',
            'inn' => 'nullable|max:255',
            'kpp' => 'nullable|max:255',
            'link_vk' => 'nullable|max:255',
            'link_facebook' => 'nullable|max:255',
            'link_inst' => 'nullable|max:255',
            'link_youtube' => 'nullable|max:255',
            'link_ok' => 'nullable|max:255',
            'link_twitter' => 'nullable|max:255',
            'link_telegram' => 'nullable|max:255',

            'leadership' => 'nullable',
            'post_category_id' => 'nullable|integer',

            'show_credits' => 'boolean',
            'show_auto_credits' => 'boolean',
            'show_credit_cards' => 'boolean',
            'show_debit_cards' => 'boolean',
            'show_deposits' => 'boolean',
            'show_mortgage' => 'boolean',
            'show_refinancing' => 'boolean',
            'show_rko' => 'boolean',
            'show_cashback' => 'boolean',
            'show_acquiring' => 'boolean',

            'author_id' => 'nullable|integer',

            'closed' => 'required|boolean',
            'status' => 'required|boolean'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'alias' => 'Алиас',

            'name' => 'Название банка',
            'full_name' => 'Полное название банка',
            'logo' => 'Логотип',
            'og_img' => 'Изображение OpenGraph',
            'title' => 'Title',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumb' => 'Хлебные крошки',
            'lead' => 'Лид-абзац',
            'content' => 'Контент',




            'licence' => 'Лицензия',
            'bik' => 'БИК',
            'account' => 'Кор. Счет',
            'address_index' => 'Индекс',
            'city_id' => 'Город главного отделения',
            'address' => 'Адрес',
            'okato' => 'ОКАТО',
            'date_opened' => 'Дата создания',
            'swift' => 'SWIFT',
            'site' => 'Сайт',
            'email' => 'Email',
            'phone' => 'Телефон',
            'ogrn' => 'ОГКН',
            'okpo' => 'ОКПО',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'leadership' => 'Руководство',
            'post_category_id' => 'Категория записей базы знаний',

            'show_credits' => 'Показывать кредиты',
            'show_auto_credits' => 'Показывать автокредиты',
            'show_credit_cards' => 'Показывать кредитные карты',
            'show_debit_cards' => 'Показывать дебетовые карты',
            'show_deposits' => 'Показывать вклады',
            'show_mortgage' => 'Показывать ипотеки',
            'show_refinancing' => 'Показывать рефинансирование',
            'show_rko' => 'Показывать РКО',
            'show_cashback' => 'Показывать кэшбэки',
            'show_acquiring' => 'Показывать эквайринг',

            'author_id' => 'ID автора',

            'closed' => 'Закрытый',
            'status' => 'Статус'
        ];
    }
}
