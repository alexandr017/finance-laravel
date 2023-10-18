<?php

namespace App\Http\Requests\CompanyReview;

use Illuminate\Foundation\Http\FormRequest;

class CompanyReviewRequest extends FormRequest
{
    const SORT_KEY = 'sort_key';
    const SORT_VALUE = 'sort_value';
    const COMPANY_ID  = 'company_id';
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

    public function getCompanyId(): int
    {
        return $this->route(self::COMPANY_ID);
    }

    public function getSortKey(): ?string
    {
        return $this->get(self::SORT_KEY);
    }

    public function getSortValue(): ?string
    {
        return $this->get(self::SORT_VALUE);
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