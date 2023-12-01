<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostsTagRequest extends FormRequest
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
            'tag' => 'max:255',
            'category_id' => 'integer'
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
            'tag' => 'Тег',
            'category_id' => 'Категория'
        ];
    }
}
