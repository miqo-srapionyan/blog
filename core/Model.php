<?php

declare(strict_types=1);

namespace core;

use PDO;
use PDOStatement;

use function password_hash;

class Model
{
    private PDO $db;
    protected string $table;

    function __construct()
    {
        $db_config = require "config/db.php";

        $this->db = new PDO("mysql:host=" . $db_config['host'] . ";dbname=" . $db_config['dbname'], $db_config['username'], $db_config['password']);
    }

    /**
     * @param string $sql
     * @param array  $params
     *
     * @return \PDOStatement
     */
    public function query(string $sql, array $params = []) : PDOStatement
    {
        $stmt = $this->db->prepare($sql);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }

        $stmt->execute();

        return $stmt;
    }

    /**
     * @param string $sql
     * @param array  $params
     *
     * @return array
     */
    public function row(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $password
     *
     * @return string
     */
    protected function bcrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
