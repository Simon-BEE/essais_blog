<?php
namespace App\Model\Entity;

use App\Helpers\Text;

class PostEntity extends Entity
{
    private $id;
    private $name;
    private $slug;
    private $content;
    private $created_at;
    private $categories = [];
    
    public function getId():int
    {
        return (int)$this->id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getSlug():string
    {
        return $this->slug;
    }

    public function getContent():string
    {
        return $this->content;
    }

    public function getCreatedAt($format = 'd/m/Y h:i'):string
    {
        return (new \DateTime($this->created_at))->format($format);
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
    
    public function setCategories(CategoryEntity $category): void
    {
        $this->categories[] = $category;
    }

    public function getExcerpt(int $length):string
    {
        return htmlentities(Text::excerpt($this->getContent(), $length));
    }

    public function getUrl():string
    {
        return \App\App::getInstance()->getRouter()->url("post", [
            "slug" => $this->getSlug(),
            "id" => $this->getId()
        ]);
    }

    public function getAdminUrl():string
    {
        return \App\App::getInstance()->getRouter()->url("admin_posts_edit", [
            "slug" => $this->getSlug(),
            "id" => $this->getId()
        ]);
    }
}
