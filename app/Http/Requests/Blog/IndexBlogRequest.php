<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class IndexBlogRequest extends FormRequest
{
    const PAGE  = 'page';
    const PER_PAGE  = 'per_page';

    public function rules(): array
    {
        return [
            self::PAGE  => [
                'int',
                'nullable',
            ],
            self::PER_PAGE  => [
                'int',
                'nullable',
            ],
        ];
    }

    public function getPage(): ?int
    {
        return $this->get(self::PAGE);
    }

    public function getPerPage(): ?int
    {
        return $this->get(self::PER_PAGE);
    }
}