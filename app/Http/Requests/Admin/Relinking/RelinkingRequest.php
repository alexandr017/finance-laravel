<?php

namespace App\Http\Requests\Admin\Relinking;

use Illuminate\Foundation\Http\FormRequest;

class RelinkingRequest extends FormRequest
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
            'category_id' => 'required|int',
            'relinking_group_id' => 'required',
            'title' => 'required',
            'link' => 'required'
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
            'relinking_group_id' => 'Название группы',
            'title' => 'Название',
            'link' => 'Ссылка'
        ];
    }

}
