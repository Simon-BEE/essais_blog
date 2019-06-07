<?php
use App\Model\Post;
use App\Connection;
$pdo = Connection::getPDO();
$categories = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_CLASS, Post::class);
$title = "Catégories";
?>
<section class="categories">
    <ul class="list-cat">
<?php foreach ($categories as $category): ?>
        <li><a href="<?= $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>"><?= $category->getName(); ?></a></li>
<?php endforeach; ?>
    </ul> 
</section>