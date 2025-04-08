<?php

declare(strict_types=1);

namespace models;

use core\Model;

class Users extends Model
{
    protected string $table = 'users';

    /**
     * @param array $data
     *
     * @return array
     */
    public function registerUser(array $data): array
    {
        $sql = "INSERT INTO `{$this->table}` (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password);";
        $data['password'] = $this->bcrypt($data['password']);
        unset($data['submit']);

        return $this->row($sql, $data);
    }

    /**
     * @param string $email
     * @param string $role
     *
     * @return array
     */
    public function getUserByEmail(string $email, string $role = 'user'): array
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `email`= :email AND `role`= :role";

        return $this->row($sql, ['email' => $email, 'role' => $role]);
    }
}
