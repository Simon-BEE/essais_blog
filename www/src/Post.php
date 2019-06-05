<?php
namespace App;

class Post {
    private $id;
    private $name;
    private $slug;
    private $content;
    private $created_at;
    
    public function getCreatedAt():string{
        return (new \DateTime($this->created_at))->format('d/m/Y h:i');
    }

    public function getId():string{
        return $this->id;
    }

    public function getName():string{
        return $this->name;
    }

    public function getSlug():string{
        return $this->slug;
    }

    public function getContent():string{
        return $this->content;
    }
}
