<?php

declare(strict_types=1);

namespace models;

use core\Model;

class BlogPost extends Model
{
    protected string $table = 'posts';

    public function getPostById($id)
    {
        $sql = "SELECT `{$this->table}`.*, COUNT(comments.id) AS comment_count, users.first_name, users.last_name
                FROM `{$this->table}` 
                LEFT JOIN comments ON {$this->table}.id = comments.post_id
                LEFT JOIN users ON {$this->table}.user_id = users.id
                WHERE `{$this->table}`.`id`=:id  AND `{$this->table}`.`status` = :status
                GROUP BY `{$this->table}`.id
                ;
                
                ";

        $data = $this->row($sql, ['id' => $id, 'status' => 1]);

        return $data;
    }

    public function saveBlogPost($data)
    {
        $sql = "INSERT INTO `{$this->table}` (title, description, status, user_id, image) VALUES (:title, :description, :status, :user_id, :image);";
        $this->row($sql, $data);
    }

    public function getAllPosts($param = null, $limit = 3, $offset = 6)
    {
        if (isset($param) && $param) {
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

    public function deletePostById($id)
    {
        $p = $this->getPostById($id);
        if (isset($p[0]['image']) && $p[0]['image']) {
            unlink('uploads/'.$p[0]['image']);
        }

        $sql = "DELETE FROM `{$this->table}` WHERE `id`=:id";

        return $this->row($sql, ['id' => $id]);
    }

    public function changeStatus($id, $status)
    {
        $sql = "UPDATE `{$this->table}`
                SET `status` = :status
                WHERE `id`=:id;";
        $this->row($sql, ['id' => $id, 'status' => !$status]);
    }

    public function getPostComments($post_id)
    {
        $sql = "SELECT comments.*, users.first_name, users.last_name
                FROM `comments` 
                LEFT JOIN `users` ON comments.user_id = users.id
                WHERE `post_id` = :post_id;";

        $data = $this->row($sql, ['post_id' => $post_id]);

        return $data;
    }
}