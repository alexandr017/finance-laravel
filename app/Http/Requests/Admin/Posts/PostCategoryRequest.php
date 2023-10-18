<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class PostCategoryRequest extends FormRequest
{
    use AdminRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'meta_description' => ['required', 'max:255'],
            'h1' => ['required', 'max:255'],
            'breadcrumbs' => ['required', 'max:255'],
            'content' => ['required'],
            'status' => ['required', 'numeric'],

            'url' => ['required', 'max:255']
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => 'Заголовок',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumbs' => 'Хлебные крошки',
            'content' => 'Контент',
            'status' => 'Статус',

            'url' => 'Url',
        ];
    }
}
