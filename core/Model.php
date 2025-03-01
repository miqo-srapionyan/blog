<?php

declare(strict_types=1);

namespace core;

use PDO;

class Model
{
    private PDO $db;
    protected string $table;

    function __construct()
    {
        $db_config = require "config/db.php";

        $this->db = new PDO("mysql:host=" . $db_config['host'] . ";dbname=" . $db_config['dbname'], $db_config['username'], $db_config['password']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();//var_dump($stmt->errorInfo());die;
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    protected function bcrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
