<?php
use App\Model\Post;
use App\Connection;

$pdo = Connection::getPDO();

//$post = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_OBJ);
$categories = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_CLASS, Post::class);
//dd($categories);


$title = "Catégories";
?>

<ul class="list-cat">
<?php foreach ($categories as $category): ?>
    <li><a href="<?= $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>"><?= $category->getName(); ?></a></li>
<?php endforeach; ?>
</ul> 
