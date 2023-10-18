<?php

namespace App\Http\Requests\Comment;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    const POST_ID = 'post_id';
    const CONTENT = 'content';
    const PARENT_ID = 'parent_id';
    const NAME = 'name';
    const EMAIL = 'email';


    public function rules(): array
    {
        $rules = [
            self::CONTENT => [
                'string',
                'required',
            ],
            self::PARENT_ID => [
                'int',
                'nullable',
            ],
            self::NAME => [
                'string',
            ],
            self::EMAIL => [
                'string',
            ],
        ];

        if (!$this->user()) {
            $rules[self::NAME][] = 'required';
            $rules[self::EMAIL][] = 'required';
        }

        return  $rules;
    }

    public function getPostId(): int
    {
        return $this->route(self::POST_ID);
    }

    public function getUserId(): ?int
    {
        return $this->user()?->id ;
    }

    public function getUserName(): string
    {
        return $this->user()?->name ?? $this->get(self::NAME);

    }

    public function getUserEmail(): string
    {
        return $this->user()?->email ?? $this->get(self::EMAIL);
    }

    public function getCommentContent(): string
    {
        return $this->get(self::CONTENT);
    }

    public function getParentId(): ?int
    {
        return $this->get(self::PARENT_ID);
    }
}
