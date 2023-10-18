<?php

namespace App\Exceptions\Company;

use App\Exceptions\BusinessLogicException;

class CompanyNotFoundException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::COMPANY_NOT_FOUND;
    }

    public function getStatusMessage(): string
    {
        return __('errors.company_not_found');
    }
}