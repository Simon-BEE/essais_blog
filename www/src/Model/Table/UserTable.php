<?php
namespace App\Model\Table;

use \Core\Model\Table;

class UserTable extends Table
{
    public function selectUser($username)
    {
        return $this->query("SELECT * FROM `user` WHERE `username` = ?", [$username], true, null);
    }

    public function insertUser($username, $password, $mail)
    {
        $this->query(
            "INSERT INTO user (username, password, mail) VALUE (:username, :password, :mail)",
            [
                ":username" => $username,
                ":password" => $password,
                ":mail"     => $mail
            ]
        );
    }

    public function allByLimit(int $limit, int $offset)
    {
        return $this->query("SELECT * FROM {$this->table} LIMIT {$limit}  OFFSET {$offset}", null, false, null);
    }
}
