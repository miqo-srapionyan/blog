<?php

declare(strict_types=1);

namespace models;

use core\Model;

class Comment extends Model
{
    protected string $table = 'comments';

    public function getPostComments($post_id)
    {
    }

    public function addComment($comment, $user_id, $post_id)
    {
        $sql = "INSERT INTO comments (content, user_id, post_id) VALUES (:content, :user_id, :post_id);";

        return $this->row($sql, ['content' => $comment, 'user_id' => $user_id, 'post_id' => $post_id]);
    }
}
