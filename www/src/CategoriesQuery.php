<?php
namespace App;
use App\Model\Category;

class CategoriesQuery{
    public static function queryCategories(int $post_id):array
    {
        $pdo = \App\Connection::getPDO();
        $query = $pdo->prepare(
            "SELECT c.id, c.slug, c.name
            FROM post_category pc 
            JOIN category c 
            ON pc.category_id = c.id 
            WHERE pc.post_id = :id");
        $query->execute([':id' => $post_id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Category::class);
        return $query->fetchAll();
    }
}