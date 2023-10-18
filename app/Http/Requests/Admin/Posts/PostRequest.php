<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class PostRequest extends FormRequest
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
            'category_id' => ['nullable', 'numeric'],
            'title' => ['required', 'max:255'],
            'meta_description' => ['required', 'max:255'],
            'h1' => ['required', 'max:255'],
            'breadcrumbs' => ['required', 'max:255'],
            'preview' => ['required', 'max:255'],
            'lead' => ['required'],
            'content' => ['required'],
            'author_id' => ['nullable', 'numeric'],
            'status' => ['required', 'numeric'],
            'rating_value' => ['nullable', 'numeric'],
            'rating_count' => ['nullable', 'numeric'],

            'url' => ['required', 'max:255'],
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
            'category_id' => 'Категория',
            'title' => 'Заголовок',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumbs' => 'Хлебные крошки',
            'preview' => 'Превью',
            'lead' => 'Лид',
            'content' => 'Контент',
            'author_id' => 'Автор',
            'status' => 'Статус',
            'rating_value' => 'Значение рейтинга',
            'rating_count' => 'Количество голосов',

            'url' => 'Url',
        ];
    }
}
