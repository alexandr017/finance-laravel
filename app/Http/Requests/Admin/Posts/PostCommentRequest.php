<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class PostCommentRequest extends FormRequest
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
            'post_id' => ['required', 'numeric'],
            'parent_id' => ['nullable', 'numeric'],
            'name' => ['nullable', 'max:255'],
            'email' => ['nullable', 'max:255'],
            //'user_id' => ['nullable', 'numeric'],
            'content' => ['required'],
            'status' => ['required', 'numeric'],
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
            'post_id' => 'Запись',
            'parent_id' => 'ID родительского отзыва',
            'name' => 'Имя',
            'email' => 'Email',
            'user_id' => 'ID пользователя',
            'content' => 'Контент',
            'status' => 'Статус',
        ];
    }
}

