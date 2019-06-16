<?php
namespace App;

class UsersQuery
{
    public static function selectUser(?string $username)
    {
        $request= \App\Connection::getPDO()->query("SELECT * FROM `user` WHERE `username` = '$username'");
        return $request->fetch(\PDO::FETCH_OBJ);
    }

    public static function insertUser(?string $username, ?string $password, ?string $mail)
    {
        $sql = "INSERT INTO user (username, password, mail) VALUE (:username, :password, :mail)";
        $request= \App\Connection::getPDO()->prepare($sql);
        $request->execute([
            ":username" => $username,
            ":password" => $password,
            ":mail"     => $mail
        ]);
    }
}