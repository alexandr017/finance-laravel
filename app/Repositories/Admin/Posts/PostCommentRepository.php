<?php

namespace App\Repositories\Admin\Posts;

use App\Repositories\Repository;
use App\Models\Posts\PostsComments;

class PostCommentRepository extends Repository
{
    const COMMENTS_PER_PAGE = 500;

    public function getForShow($postId = null)
    {
        return PostsComments::select([
                'posts_comments.*',
                'posts.h1',
                'users.email',
                'users.name',
                'authors.name as vzo_author_name'
            ])
            ->join('posts', 'posts.id', '=', 'posts_comments.pid')
            ->leftjoin('users', 'users.id', '=', 'posts_comments.uid')
            ->leftJoin('authors','authors.id','posts_comments.vzo_author')
            ->when($postId, function ($query) use ($postId) {
                $query->where(['posts_comments.pid' => $postId]);
            })
            ->orderBy('id','desc')
            ->paginate(self::COMMENTS_PER_PAGE);
    }

    public function getForSearch($search)
    {
        return PostsComments::select([
                'posts_comments.*',
                'posts.h1',
                'users.email',
                'users.name'
            ])
            ->join('posts', 'posts.id', '=', 'posts_comments.pid')
            ->leftjoin('users', 'users.id', '=', 'posts_comments.uid')
            ->where('posts_comments.comment', 'like', '%' . $search . '%')
            ->orderBy('id','desc')
            ->paginate(self::COMMENTS_PER_PAGE);
    }

    public function getForEdit($id)
    {
        return PostsComments::findOrFail($id);
    }

    public function getForDelete($id)
    {
        return PostsComments::findOrFail($id);
    }
}
