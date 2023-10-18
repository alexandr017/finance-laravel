<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class IndexCoursesRequest extends FormRequest
{
    const SORT_KEY = 'sort_key';
    const SORT_VALUE = 'sort_value';
    const LISTING_ID  = 'listing_id';
    const TAGS  = 'tags';
    const PAGE  = 'page';
    const PER_PAGE  = 'per_page';

    public function rules(): array
    {
        return [
            self::SORT_KEY => [
                'string',
                'nullable',
            ],
            self::SORT_VALUE  => [
                'string',
                'nullable',
            ],
            self::TAGS  => [
                'array',
                'nullable',
            ],
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

    public function getListingId(): int
    {
        return $this->route(self::LISTING_ID);
    }

    public function getSortKey(): ?string
    {
        return $this->get(self::SORT_KEY);
    }

    public function getSortValue(): ?string
    {
        return $this->get(self::SORT_VALUE);
    }

    public function getTags(): ?array
    {
        return $this->get(self::TAGS);
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