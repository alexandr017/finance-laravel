<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class UserRequest extends FormRequest
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
            'employee_id' => ['required', 'numeric'],
            'role_id' => ['required', 'numeric'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'middle_name' => ['nullable', 'max:255'],
            'email' => ['required', 'max:255'],
            'password' => ['nullable', 'max:255'],
            'last_active' => ['nullable', 'max:255'],
            // todo доделать валидацию и attributes ниже
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
            'employee_id' => 'Сотрудник',
            'role_id' => 'Роль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчетсво',
            'email' => 'Email',
            'password' => 'Пароль',
            'last_active' => 'Последняя активность',
        ];
    }
}
