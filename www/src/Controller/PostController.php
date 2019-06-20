<?php
namespace App\Controller;

use \App\Model\Entity\PostEntity;
use \App\Model\Entity\CategoryEntity;
use \App\Model\Table\PostTable;
use \App\Model\Table\CategoryTable;
use \App\Controller\Database\DatabaseController;

class PostController extends Controller
{
    public function __construct()
    {
        $this->loadModel('post');
        $this->loadModel('category');
    }

    public function all()
    {
        $paginatedQuery = new PaginatedQueryController(
            $this->post,
            $this->generateUrl('home')
        );
        
        $postById = $paginatedQuery->getItems();
        $title = 'Home';
        $this->render("post/all", ["title" => $title, "posts" => $postById, "paginate" => $paginatedQuery->getNavHtml()]);
    }

    public function show(string $slug, int $id)
    {

        $post = $this->post->find($id);

        if (!$post) {
            throw new \Exception('Aucun article ne correspond à cet ID');
        }
        if ($post->getSlug() !== $slug) {
            $url = $this->generateUrl('post', ['id' => $id, 'slug' => $post->getSlug()]);
            http_response_code(301);
            header('Location: ' . $url);
            exit();
        }
        $categories = $this->category->allInId($post->getId());
        
        $title = "article : " . $post->getName();
        
        $this->render("post/show",[
            "title" => $title,
            "categories" => $categories,
            "post" => $post
        ]);
    }
}