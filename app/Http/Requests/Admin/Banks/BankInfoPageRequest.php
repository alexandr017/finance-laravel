<?php

namespace App\Http\Requests\Admin\Banks;

use Illuminate\Foundation\Http\FormRequest;

class BankInfoPageRequest extends FormRequest
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
            'type_id' => 'required|integer',
            'title' => 'required|max:255',
            'meta_description' => 'required',
            'h1' => 'required|max:255',
            'breadcrumb' => 'nullable|max:500',
            'content' => 'nullable',
            'lead' => 'nullable',
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
            'type_id' => 'Тип страницы',
            'title' => 'Title',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumb' => 'Хлебные крошки',
            'content' => 'Контент',
            'lead' => 'Лид',
            'status' => 'Статус'
        ];
    }
}
