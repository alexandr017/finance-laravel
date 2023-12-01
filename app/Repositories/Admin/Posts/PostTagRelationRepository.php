<?php

namespace App\Repositories\Admin\Posts;

use App\Repositories\Repository;
use App\Models\Posts\PostsTagsRelations as Model;

class PostTagRelationRepository extends Repository
{
    /**
     * @param $postID int
     * @return array
     */
    public function getForSelectByPostId($postID) : array
    {
        return Model
            ::select('id', 'tag_id')
            ->where(['post_id' => $postID])
            ->pluck('tag_id','id')
            ->toArray();
    }

}
