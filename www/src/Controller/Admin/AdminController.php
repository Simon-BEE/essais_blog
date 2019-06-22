<?php
namespace App\Controller\Admin;

use \Core\Controller\Controller;
use \Core\Controller\PaginatedQueryController;
use App\Controller\PaginatedQueryAppController;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->loadModel('post');
        $this->loadModel('category');
        $this->loadModel('user');
    }

    public function index()
    {
        $latestPost = $this->post->latestById();
        $latestCategory = $this->category->latestById();
        $latestUser = $this->user->latestById();
        $title = "Index";

        $this->render("admin/index", [
            "title" => $title,
            "post" => $latestPost,
            "category" => $latestCategory,
            "user" => $latestUser
            ]);
    }

    public function posts()
    {
        $paginatedQuery = new PaginatedQueryAppController(
            $this->post,
            $this->generateUrl('admin_posts')
        );

        $postById = $paginatedQuery->getItems();
        $title = "Posts";

        $this->render("admin/posts", [
            "title" => $title,
            "posts" => $postById,
            "paginate" => $paginatedQuery->getNavHtml()
            ]);
    }

    public function categories()
    {
        $paginatedQuery = new PaginatedQueryAppController(
            $this->category,
            $this->generateUrl('admin_categories')
        );

        $categories = $paginatedQuery->getItems();
        $title = "Categories";

        $this->render("admin/categories", [
            "title" => $title,
            "categories" => $categories,
            "paginate" => $paginatedQuery->getNavHtml()
            ]);
    }

    public function users()
    {
        $paginatedQuery = new PaginatedQueryAppController(
            $this->user,
            $this->generateUrl('admin_users')
        );

        $users = $paginatedQuery->getItems();
        $title = "Users";

        $this->render("admin/users", [
            "title" => $title,
            "users" => $users,
            "paginate" => $paginatedQuery->getNavHtml()
            ]);
    }
}
