<?php

namespace App\Http\Requests\Admin\StaticPages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class StaticPageRequest extends FormRequest
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
            'breadcrumbs' => ['nullable', 'max:255'],
            'lead' => ['nullable'],
            'content' => ['nullable'],
            'rating_value' => ['nullable', 'numeric'],
            'rating_count' => ['nullable', 'numeric'],
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
            'lead' => 'Лид',
            'content' => 'Контент',
            'rating_value' => 'Значение рейтинга',
            'rating_count' => 'Количество голосов',
        ];
    }
}
