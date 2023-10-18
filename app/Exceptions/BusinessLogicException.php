<?php

namespace App\Exceptions;

use Exception;

abstract class BusinessLogicException extends Exception
{
    const VALIDATION_FAILED = 600;
    const SAVING_ERROR = 601;
    const LISTING_NOT_FOUND = 602;
    const COMPANY_NOT_FOUND = 603;
    const POST_CATEGORY_NOT_FOUND = 604;

    abstract public function getStatus(): int;
    abstract public function getStatusMessage(): string;
}