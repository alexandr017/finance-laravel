<?php

namespace App\Http\Requests\Admin\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\Admin\AdminRequestTrait;

class CompanyReviewRequest extends FormRequest
{
    use AdminRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "school_id" => ["required"],
            "title" => ["required"],
            "pluses" => ["nullable"],
            "minuses" => ["nullable"],
            "content" => ["required"],
            "rating" => ["required", "numeric"],
            "author_name" => ["nullable"],
            "status" => ["required", "numeric"],

            "character_code", // todo наверно эти поля не надо
            "sort",
            "code"
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
            "school_id" => "Школа",
            "title" => "Заголовок",
            "pluses" => "Плюсы",
            "minuses" => "Минусы",
            "content" => "Контент",
            "rating" => "Рейтинг",
            "author_name" => "Имя автора",
            "status" => "Статус"
        ];
    }

}
