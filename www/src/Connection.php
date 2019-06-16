<?php
namespace App;

class Connection
{
    public static function getPDO()
    {
        $pdo = new \PDO(
            "mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'),
            getenv('MYSQL_USER'),
            getenv('MYSQL_PASSWORD')
        );

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
