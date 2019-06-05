<?php
use App\Model\Post;

try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$id = (int)$params['id'];
$slug = $params['slug'];

$sql = "SELECT * FROM post WHERE id = ?";
$state = $pdo->prepare($sql);
$state->execute([$id]);
$state->setFetchMode(PDO::FETCH_CLASS, Post::class);
$post = $state->fetch();
//dd($post);
$title = $post->getName();

?>

<section class="post">
    <article class="card">
        <h1 class="card-title text-center"><?= $title; ?></h1>
        <p class="card-text"><?= $post->getContent(); ?></p>
        <p class="card-footer"><?= $post->getCreatedAt(); ?></p>
    </article>
</section>
