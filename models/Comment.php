<?php

declare(strict_types=1);

namespace models;

use core\Model;

class Comment extends Model
{
    protected string $table = 'comments';

    /**
     * @param string $comment
     * @param int    $user_id
     * @param int    $post_id
     *
     * @return array
     */
    public function addComment(string $comment, int $user_id, int $post_id): array
    {
        $sql = "INSERT INTO comments (content, user_id, post_id) VALUES (:content, :user_id, :post_id);";

        return $this->row($sql, ['content' => $comment, 'user_id' => $user_id, 'post_id' => $post_id]);
    }
}
