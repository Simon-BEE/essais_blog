<?php
use App\Model\Post;

try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
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
