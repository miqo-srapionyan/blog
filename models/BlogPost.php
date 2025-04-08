<?php

declare(strict_types=1);

namespace models;

use core\Model;

class BlogPost extends Model
{
    protected string $table = 'posts';

    /**
     * @param array $data
     *
     * @return void
     */
    public function saveBlogPost(array $data): void
    {
        $sql = "INSERT INTO `{$this->table}` (title, description, status, user_id, image) VALUES (:title, :description, :status, :user_id, :image);";
        $this->row($sql, $data);
    }

    /**
     * @param array|null $param
     * @param int        $limit
     * @param int        $offset
     *
     * @return array
     */
    public function getAllPosts(?array $param = null, int $limit = 3, int $offset = 6): array
    {
        if (!empty($param)) {
            $sql = "SELECT `{$this->table}`.*, COUNT(comments.id) AS comment_count, users.first_name, users.last_name 
                FROM `{$this->table}` 
                LEFT JOIN comments ON {$this->table}.id = comments.post_id
                LEFT JOIN users ON {$this->table}.user_id = users.id
                
                 WHERE `{$this->table}`.status = :status 
                 
                 GROUP BY `{$this->table}`.id  ORDER BY `{$this->table}`.id ASC  LIMIT {$limit} OFFSET {$offset};";
        } else {
            $sql = "SELECT `{$this->table}`.*, COUNT(comments.id) AS comment_count, users.first_name, users.last_name
                FROM `{$this->table}` 
                LEFT JOIN comments ON {$this->table}.id = comments.post_id
                LEFT JOIN users ON {$this->table}.user_id = users.id
                GROUP BY `{$this->table}`.id ORDER BY `{$this->table}`.id ASC 
                ;";
        }

        return $this->row($sql, $param);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function deletePostById(int $id): array
    {
        $p = $this->getPostById($id);
        if (isset($p[0]['image']) && $p[0]['image']) {
            unlink('uploads/'.$p[0]['image']);
        }

        $sql = "DELETE FROM `{$this->table}` WHERE `id`=:id";

        return $this->row($sql, ['id' => $id]);
    }

    /**
     * @param int $id
     * @param int $status
     *
     * @return void
     */
    public function changeStatus(int $id, int $status): void
    {
        $sql = "UPDATE `{$this->table}`
                SET `status` = :status
                WHERE `id`=:id;";
        $this->row($sql, ['id' => $id, 'status' => !$status]);
    }

    public function getPostComments(int $post_id): array
    {
        $sql = "SELECT comments.*, users.first_name, users.last_name
                FROM `comments` 
                LEFT JOIN `users` ON comments.user_id = users.id
                WHERE `post_id` = :post_id;";

        return $this->row($sql, ['post_id' => $post_id]);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getPostById(int $id): array
    {
        $sql = "SELECT `{$this->table}`.*, COUNT(comments.id) AS comment_count, users.first_name, users.last_name
                FROM `{$this->table}` 
                LEFT JOIN comments ON {$this->table}.id = comments.post_id
                LEFT JOIN users ON {$this->table}.user_id = users.id
                WHERE `{$this->table}`.`id`=:id  AND `{$this->table}`.`status` = :status
                GROUP BY `{$this->table}`.id
                ;
                
                ";

        return $this->row($sql, ['id' => $id, 'status' => 1]);
    }
}