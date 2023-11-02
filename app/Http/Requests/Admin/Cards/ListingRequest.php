<?php

namespace App\Http\Requests\Admin\Cards;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
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
            'category_id' => 'required|integer',
//            'parent_id' => 'nullable|integer',
            'title' => 'required|max:255',
            'meta_description' => 'required',
            'h1' => 'required|max:255',
            'alias' => 'required|max:255',
            'breadcrumb' => 'nullable|max:500',
//            'h2' => 'nullable|max:255',
//            'img' => 'nullable|max:255',
//            'og_img' => 'nullable|max:50',
//            'infographic' => 'nullable|max:255',
            'lead' => 'required',
            'content' => 'nullable',
//            'total_compare_label' => 'nullable|max:255',
//            'total_compare_text' => 'nullable',
//            'city_id' => 'nullable|integer',
//            'number_in_exel' => 'nullable|integer',
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
            'category_id' => 'Категория',
            'parent_id' => 'ID родительского листинга',
            'parent_table' => 'Тип таблицы к которому пренадлежит родителсткий листинг',
            'title' => 'Title',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'url' => 'URL',
            'breadcrumb' => 'Хлебные крошки',
            'expert_anchor' => 'Якорь на экспертное мнение',
            'h2' => 'h2',
            'img' => 'Изображение',
            'og_img' => 'Изображение OpenGraph',
            'infographic' => 'Идентификатор инфографики',
            'lead' => 'Лид-абзац',
            'content' => 'Контент',
            'total_compare_label' => 'Метка итогового сравнения',
            'total_compare_text' => 'Текст итогового сравнения',
            'city_id' => 'Город',
            'number_in_exel' => 'Номер в базе ВЗО',
            'status' => 'Статус'
        ];
    }
}
