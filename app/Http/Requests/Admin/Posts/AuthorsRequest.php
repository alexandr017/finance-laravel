<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorsRequest extends FormRequest
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
            'name' => ['required', Rule::unique('authors')->ignore($this->id)],
            'position' => 'required',
            'roditelny' => 'required',
            'email' => 'required',
            'photo' => 'required',
            'text' => 'required',
            'sort_order' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => '"Имя" обязательное поле',
            'position.required' => 'Должность обязательное поле',
            'email.required' => '"Email" обязательное поле',
            'photo.required' => '"Фото" обязательное поле',
            'text.required' => '"Текст" обязательное поле',
            'sort_order.required' => '"Порядок" обязательное поле',
        ];
    }

}