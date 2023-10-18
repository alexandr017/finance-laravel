<?php

namespace App\Http\Requests\CompanyReview;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyReviewRequest extends FormRequest
{
    const COMPANY_ID = 'company_id';
    const RATE = 'rate';
    const NAME = 'name';
    const PLUSES = 'pluses';
    const MINUSES = 'minuses';
    const CONTENT = 'content';

    public function rules(): array
    {
        return [
            self::RATE => [
                'numeric',
                'min:0',
                'max:5',
            ],
            self::NAME => [
                'string',
                'required',
            ],
            self::MINUSES => [
                'string',
                'nullable',
            ],
            self::PLUSES => [
                'string',
                'nullable',
            ],
            self::CONTENT => [
                'string',
                'nullable',
            ],
        ];
    }

    public function getCompanyId(): int
    {
        return $this->route(self::COMPANY_ID);
    }

    public function getRate(): float
    {
        return $this->get(self::RATE);
    }

    public function getUserId(): ?int
    {
        return $this->user()?->id;
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }

    public function getPluses(): ?string
    {
        return $this->get(self::PLUSES);
    }

    public function getMinuses(): ?string
    {
        return $this->get(self::MINUSES);
    }

    public function getContentText(): ?string
    {
        return $this->get(self::CONTENT);
    }
}