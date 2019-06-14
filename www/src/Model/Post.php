<?php
namespace App\Model;

use App\Helpers\Text;

class Post
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

    public function setCategories($category){
        $this->categories = $category;
    }

    public function getCategories(){
        return $this->categories;
    }

    public function getExcerpt(int $length):string
    {
        return htmlentities(Text::excerpt($this->getContent(), $length));
    }
}

// $postById = [];
// foreach ($posts as $post) {
//    $postById[$post->getId()] = $post;
// }
// foreach ($categories as $category) {
//    $postById[$category->post_id]->setCategories($category);
// }
