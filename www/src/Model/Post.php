<?php
namespace App\Model;

class Post {
    private $id;
    private $name;
    private $slug;
    private $content;
    private $created_at;
    
    public function getId():int{
        return (int)$this->id;
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

    public function getCreatedAt($format = 'd/m/Y h:i'):string{
        return (new \DateTime($this->created_at))->format($format);
    }
    
}
