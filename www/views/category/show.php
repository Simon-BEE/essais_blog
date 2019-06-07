<?php
use App\Model\{Post, Category};
use App\Connection;
use App\PaginatedQuery;

$pdo = Connection::getPDO();
$id = (int)$params['id'];
$slug = $params['slug'];

$sql3 = "SELECT * FROM category WHERE id =?";
$state3 = $pdo->prepare($sql3);
$state3->execute([$id]);
$state3->setFetchMode(PDO::FETCH_CLASS, Post::class);
$categ = $state3->fetch();
$title = "Category : ".$categ->getName();

$url = $router->url("category", ["id" => $categ->getId(), "slug" => $categ->getSlug()]);
$paginatedQuery = new App\PaginatedQuery(
    "SELECT count(category_id) FROM post_category WHERE category_id = {$categ->getId()}", 
    "SELECT p.*
        FROM post p
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id = {$categ->getId()}
        ORDER BY created_at DESC",
    Post::class,
    $url
);
$posts = $paginatedQuery->getItems();

if (!$posts) {
    throw new Exception('Aucune catégorie ne correspond à cet Id !');
}

if ($categ->getSlug() !== $slug) {
    $url = $router->url('category', ['id' => $categ->getId(), 'slug' => $categ->getSlug()]);
    http_response_code(301);
    header('location: '.$url);
    exit();
}
?>

<section class="articles">
<?php foreach($posts as $post){
    require dirname(__dir__).'/post/card.php';
} ?>
</section>

<?php 
echo $paginatedQuery->getNav();
?>
