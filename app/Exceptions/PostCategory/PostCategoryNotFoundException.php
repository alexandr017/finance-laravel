<?php

namespace App\Exceptions\PostCategory;

use App\Exceptions\BusinessLogicException;

class PostCategoryNotFoundException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::POST_CATEGORY_NOT_FOUND;
    }

    public function getStatusMessage(): string
    {
        return __('errors.post_category_not_found');
    }
}