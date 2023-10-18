<?php

namespace App\Exceptions\Listing;

use App\Exceptions\BusinessLogicException;

class ListingNotFoundException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::LISTING_NOT_FOUND;
    }

    public function getStatusMessage(): string
    {
        return __('errors.listing_not_found');
    }
}