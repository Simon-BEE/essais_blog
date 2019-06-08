<?php
use App\Model\Post;
use App\Connection;
$pdo = Connection::getPDO();
$categories = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_CLASS, Post::class);

$url = $router->url("categories");
$paginatedQuery = new App\PaginatedQuery(
    "SELECT count(id) FROM category", 
    "SELECT * FROM category ORDER BY id",
    Post::class,
    $url,
    10
);
$categories = $paginatedQuery->getItems();

$title = "Catégories";
?>
<section class="categories">
    <ul class="list-cat">
<?php foreach ($categories as $category): ?>
        <li><a href="<?= $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>"><?= $category->getName(); ?></a></li>
<?php endforeach; ?>
    </ul> 
</section>
<?php echo $paginatedQuery->getNavHtml(); ?>