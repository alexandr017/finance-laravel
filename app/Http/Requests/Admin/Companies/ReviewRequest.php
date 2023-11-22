<?php

namespace App\Http\Requests\Admin\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
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
            'author' => 'required',
            'review' => 'required',
            'company_id' => 'required',
            'rating' => 'nullable',
            'pros' => 'nullable',
            'minuses' => 'nullable',
            'answer' => 'nullable',
            'parent_id' => 'nullable',
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'author.required' => '"Автор" обязательное поле',
            'review.required' => '"Отзыв" обязательное поле',
            'company_id.required' => '"Компания" обязательное поле',
        ];
    }

}