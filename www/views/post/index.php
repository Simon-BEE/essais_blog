<?php
/**
 * fichier qui génère la vue pour l'url /article/[i:id]
 * 
 */

try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$id = (int)$params['id'];
$slug = $params['slug'];

$sql = "SELECT * FROM post WHERE id = ?";
$state = $pdo->prepare($sql);
$post = $state->execute([$id]);
//$post->setFetchMode(\PDO::FETCH_CLASS, Post::class);
$post = $state->fetch(PDO::FETCH_OBJ);

$title = $post->name;

?>

<section class="post">
    <article class="card">
        <h1 class="card-title text-center"><?= $title; ?></h1>
        <p class="card-text"><?= $post->content; ?></p>
        <p class="card-footer"><?= (new DateTime($post->created_at))->format('d/m/Y h:i'); ?></p>
    </article>
</section>
