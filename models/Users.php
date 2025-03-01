<?php

declare(strict_types=1);

namespace models;

use core\Model;

class Users extends Model
{
    protected string $table = 'users';

    public function getUserByEmailPassword($email, $password)
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `email`= :email, `password` = :password";

        return $this->row($sql, ['email' => $email, 'password' => $password]);
    }

    public function registerUser($data)
    {
        $sql = "INSERT INTO `{$this->table}` (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password);";
        $data['password'] = $this->bcrypt($data['password']);
        unset($data['submit']);

        return $this->row($sql, $data);
    }

    public function getUserByEmail($email, $role = 'user')
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `email`= :email AND `role`= :role";

        return $this->row($sql, ['email' => $email, 'role' => $role]);
    }
}
