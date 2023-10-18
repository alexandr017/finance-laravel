<?php

namespace App\Http\Requests\ListingRating;

use Illuminate\Foundation\Http\FormRequest;

class CreateListingRatingRequest extends FormRequest
{
    const LISTING_ID = 'listing_id';
    const RATE = 'rating_value';

    public function rules(): array
    {
        return [
            self::RATE => [
                'numeric',
                'min:0',
                'max:5',
            ]
        ];
    }

    public function getListingId(): int
    {
        return $this->route(self::LISTING_ID);
    }

    public function getRate(): float
    {
        return $this->get(self::RATE);
    }

    public function getUserId(): ?int
    {
        return $this->user()?->id;
    }
}