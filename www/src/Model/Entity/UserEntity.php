<?php
namespace App\Model\Entity;

class UserEntity extends Entity
{
    private $id;
    private $username;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}