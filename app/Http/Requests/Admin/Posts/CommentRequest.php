<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
            'pid' => 'required',
            'comment' => 'required',
            'author_name' => ['nullable', 'max:255', Rule::requiredIf(!$this->uid && !$this->vzo_author)],
            'author_email' => ['nullable', 'max:255'],
            'uid' => ['nullable', 'int', Rule::requiredIf(!$this->author_name && !$this->vzo_author)],
            'parent' => ['nullable', 'int'],
            'status' => ['required', 'boolean'],
            'vzo_author' => ['nullable', Rule::requiredIf(!$this->author_name && !$this->uid)]
        ];
    }

    public function messages()
    {
        return [
            'pid.required' => '"Запись" обязательное поле',
            'comment.required' => '"Комментарий" обязательное поле',
            'comment.status' => '"Статус" обязательное поле',
            'author_name.required' => 'Поле "Имя автора" или "ID пользователя" или "Автор ВЗО" обязательные',
            'uid.required' => 'Поле "Имя автора" или "ID пользователя" или "Автор ВЗО" обязательные',
            'vzo_author.required' => 'Поле "Имя автора" или "ID пользователя" или "Автор ВЗО" обязательные',
        ];
    }

}