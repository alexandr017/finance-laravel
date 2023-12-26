<?php

namespace App\Http\Requests\Admin\Relinking;

use Illuminate\Foundation\Http\FormRequest;

class RelinkingGroupRequest extends FormRequest
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
            'group_name' => 'required',
            'category_id' => 'required'
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
            'group_name' => 'Название группы'
        ];
    }

}
