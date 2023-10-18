<?php

namespace App\Http\Requests\Admin\Employees;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class EmployeeRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'photo' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'meta_description' => ['required', 'max:255'],
            'h1' => ['required', 'max:255'],
            'breadcrumbs' => ['required', 'max:255'],
            'lead' => ['required'],
            'content' => ['required'],
            'status' => ['required', 'numeric'],
            'rating_value' => ['nullable', 'numeric'],
            'rating_count' => ['nullable', 'numeric'],
            'job' => ['nullable', 'max:255'],
            'email' => ['nullable', 'max:255'],
            'vk_link' => ['nullable', 'max:255'],
            'telegram_link' => ['nullable', 'max:255'],
            'education' => ['nullable', 'max:255'],
            'sort_order' => ['nullable', 'numeric'],

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
            'name' => 'Имя',
            'photo' => 'Фото',
            'title' => 'Заголовок',
            'meta_description' => 'Мета описание',
            'h1' => 'h1',
            'breadcrumbs' => 'Хлебные крошки',
            'content' => 'Контент',
            'status' => 'Статус',
            'rating_value' => 'Значение рейтинга',
            'rating_count' => 'Количество голосов',
            'job' => 'Работа/Должность',
            'email' => 'Email',
            'vk_link' => 'Ссылка ВК',
            'telegram_link' => 'Ссылка телеграм',
            'education' => 'Образование',
            'sort_order' => 'Порядок отображения/ сортировки',

            'url' => 'Url',
        ];
    }
}
