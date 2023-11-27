<?php

namespace App\Http\Requests\Admin\Banks;

use Illuminate\Foundation\Http\FormRequest;

class BankProductRequest extends FormRequest
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
            'product_name' => 'required|max:255',
            'title' => 'required|max:255',
            'meta_description' => 'required',
            'h1' => 'required|max:255',
            'breadcrumb' => 'nullable|max:255',
            'alias' => 'nullable|max:255',
            'is_cashback' => 'required|boolean',
            'img' => 'nullable|max:255',
            'img_og' => 'nullable|max:255',
            'lead' => 'nullable',
            'content' => 'nullable',
            'scale_1' => 'nullable|integer',
            'scale_2' => 'nullable|integer',
            'scale_3' => 'nullable|integer',
            'scale_4' => 'nullable|integer',
            'scale_5' => 'nullable|integer',
            'closed' => 'boolean',
            'separate_page' => 'required|boolean',
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
            'product_name' => 'Название продукта',
            'title' => 'Title',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumb' => 'Хлебные крошки',
            'alias' => 'Алиас',
            'is_cashback' => 'Относится к категории кэшбэк',
            'img' => 'Изображение',
            'img_og' => 'Изображение OpenGraph',
            'lead' => 'Лид - абзац',
            'content' => 'Контент',
            'scale_1' => 'Шкала 1',
            'scale_2' => 'Шкала 2',
            'scale_3' => 'Шкала 3',
            'scale_4' => 'Шкала 4',
            'scale_5' => 'Шкала 5',
            'closed' => 'Закрытая компания',
            'separate_page' => 'Продукт имеет отдельную страницу',
            'status' => 'Статус'
        ];
    }
}
