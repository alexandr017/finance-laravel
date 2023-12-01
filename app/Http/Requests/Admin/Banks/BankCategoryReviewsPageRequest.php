<?php

namespace App\Http\Requests\Admin\Banks;

use Illuminate\Foundation\Http\FormRequest;

class BankCategoryReviewsPageRequest extends FormRequest
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
            'title' => 'required|max:255',
            'meta_description' => 'required',
            'h1' => 'required|max:255',
            'breadcrumb' => 'nullable|max:500',
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
            'title' => 'Title',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumb' => 'Хлебные крошки',
            'content' => 'Контент',
            'status' => 'Статус'
        ];
    }
}
