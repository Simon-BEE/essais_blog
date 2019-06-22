<?php
namespace App\Controller\Admin;

use Core\Controller\Controller;
use Core\Controller\PaginatedQueryController;

class CategoryEditController extends Controller
{
    public function __construct()
    {
        $this->loadModel('post');
        $this->loadModel('category');
    }

    public function categoryEdit($slug, $id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            throw new Exception('Aucune categorie ne correspond à cet ID');
        }
        if ($category->getSlug() !== $slug) {
            $url = $this->generateUrl('category', ['id' => $id, 'slug' => $category->getSlug()]);
            http_response_code(301);
            header('Location: ' . $url);
            exit();
        }
        $uri = $this->generateUrl("category", ["id" => $category->getId(), "slug" => $category->getSlug()]);
        $paginatedQuery = new PaginatedQueryController(
            $this->post,
            $this->generateUrl('category', ["id" => $category->getId(), "slug" => $category->getSlug()])
        );
        $postById = $paginatedQuery->getItemsInId($id);

        $title = $category->getName();
        
        $this->render("admin/categoryEdit", [
            "title" => $title,
            "category" => $category,
            "posts" => $postById
        ]);
    }

    public function categoryUpdate()
    {
        if (isset($_POST)) {
            $id = $_POST['cat_id'];
            ;
            if (!empty($_POST['cat_name'])) {
                (string)$name = $_POST['cat_name'];
                $this->category->update("name", $name, $id);
                header('location: /admin/categories');
            }
            if (!empty($_POST['cat_slug'])) {
                (string)$slug = $_POST['cat_slug'];
                if (preg_match("#^[a-zA-Z0-9_-]*$#", $slug)) {
                    $this->category->update("slug", $slug, $id);
                    header('location: /admin/categories');
                } else {
                    dd('error');
                }
            }
        }
    }
}
