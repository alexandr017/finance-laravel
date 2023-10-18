<?php

namespace App\Http\Requests\Admin\Listings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class ListingRequest extends FormRequest
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
        // todo помоему тут много лишних полей? title description slug rating_sum
        return [
            'parent_id' => [],
            'name' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'description' => [],
            'slug' => [],
            'meta_description' => ['required', 'max:255'],
            'meta_title' => [],
            'h1' => ['required', 'max:255'],
            'breadcrumbs' => ['required', 'max:255'],
            'lead' => ['nullable'],
            'content' => ['nullable'],
            'author_id' => ['required', 'numeric'],
            'rating_value' => ['nullable'],
            'rating_count' => ['nullable'],
            'rating_sum' => [],
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
            'parent_id' => 'Родительский листинг',
            'name' => 'Название',
            'title' => 'Заголовок',
            'meta_description' => 'Мета описание',

            'description' => '?',
            'slug' => '?',
            'meta_title' => '?',

            'h1' => 'h1',
            'breadcrumbs' => 'Хлебные крошки',
            'lead' => 'Лид',
            'content' => 'Контент',
            'author_id' => 'Автор',
            'status' => 'Статус',
            'rating_value' => 'Значение рейтинга',
            'rating_count' => 'Количество голосов',
            'rating_sum' => '?',

            'url' => 'Url',
        ];
    }
}
