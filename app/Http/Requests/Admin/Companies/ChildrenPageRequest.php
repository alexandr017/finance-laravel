<?php

namespace App\Http\Requests\Admin\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChildrenPageRequest extends FormRequest
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
            'company_id' => ['required'],
            'type_id' => ['required', Rule::unique('companies_children_pages')->ignore($this->id)->where('company_id', $this->company_id)],
            'h1' => ['required'],
            'title' => ['required'],
            'breadcrumb' => ['nullable'],
            'content' => ['required'],
            'meta_description' => ['required'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'company_id.required' => '"Id компании" обязательное поле',
            'type_id.required' => '"Тип" обязательное поле',
            'type_id.unique' => 'Страница с таким полем "Тип" уже существует',
            'h1.required' => '"H1" обязательное поле',
            'title.required' => '"Title" обязательное поле',
            'meta_description.required' => '"Мета - описание" обязательное поле',
            'status.required' => '"Статус" обязательное поле',
        ];
    }

}