<?php

namespace App\Http\Requests\Admin\Banks;

use Illuminate\Foundation\Http\FormRequest;

class BankCategoryPageRequest extends FormRequest
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
            'title' => 'required|max:255',
            'meta_description' => 'required',
            'h1' => 'required|max:255',
            'breadcrumb' => 'nullable|max:500',
            'lead' => 'nullable',
            'scale_1' => 'nullable|integer',
            'scale_2' => 'nullable|integer',
            'scale_3' => 'nullable|integer',
            'scale_4' => 'nullable|integer',
            'scale_5' => 'nullable|integer',
            'content' => 'nullable',
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
            'title' => 'Title',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumb' => 'Хлебные крошки',
            'lead' => 'Лид',
            'scale_1' => 'Шкала 1',
            'scale_2' => 'Шкала 2',
            'scale_3' => 'Шкала 3',
            'scale_4' => 'Шкала 4',
            'scale_5' => 'Шкала 5',
            'content' => 'Контент',
            'status' => 'Статус'
        ];
    }
}
