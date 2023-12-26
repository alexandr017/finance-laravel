<?php

namespace App\Http\Requests\Admin\HideLinks;

use Illuminate\Foundation\Http\FormRequest;

class HideLinksRequests extends FormRequest
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
            'in' => 'required|string|max:500',
            'out' => 'required|string|max:500',
            'straight' => 'required|string|max:500'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'in.required' => 'Поле "Ссылка на сайте" обязательно к заполнению',
            'in.max' => 'Поле "Ссылка на сайте" должно быть менее 255 символов',
            'out.required' => 'Поле "Целевая ссылка" обязательно к заполнению',
            'out.max' => 'Поле "Целевая ссылка" должно быть менее 255 символов',
            'straight.required' => 'Поле "Прямая ссылка" обязательно к заполнению',
            'straight.max' => 'Поле "Прямая ссылка" должно быть менее 255 символов',

        ];

    }

}
