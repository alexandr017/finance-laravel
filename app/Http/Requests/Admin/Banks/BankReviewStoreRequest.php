<?php

namespace App\Http\Requests\Admin\Banks;

use Illuminate\Foundation\Http\FormRequest;

class BankReviewStoreRequest extends FormRequest
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
            'parent_id' => 'nullable|integer',
            'author' => 'required|max:255',
            'uid' => 'nullable|integer',
            'review' => 'nullable',
            'rating' => 'nullable|numeric',
            'pros' => 'nullable',
            'minuses' => 'nullable',
            'answer' => 'nullable',
            'off_answer' => 'nullable',
            'bank_id' => 'required|integer',
            'bank_category_id' => 'required|integer',
            'product_id' => 'required|integer|min:1',
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
            'parent_id' => 'ID родительского отзыва',
            'author' => 'Автор',
            'review' => 'Отзыв',
            'rating' => 'Рейтинг',
            'pros' => 'Плюсы',
            'minuses' => 'Минусы',
            'answer' => 'Ответ',
            'off_answer' => 'nullable',
            'bank_id' => 'Банк',
            'bank_category_id' => 'Категория',
            'product_id' => 'Продукт',
            'status' => 'Статус'
        ];
    }
}
