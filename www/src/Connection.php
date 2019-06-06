<?php
namespace App;

class Connection{
    public function getPDO(){
        return new \PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    }
}