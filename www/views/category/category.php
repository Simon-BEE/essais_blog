<?php
use App\Model\Post;
use App\Helpers\Text;

try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$id = (int)$params['id'];
$slug = $params['slug'];

$sql = "SELECT * FROM post_category WHERE category_id =?";
$state = $pdo->prepare($sql);
$state->execute([$id]);
$postsCat = $state->fetchAll(PDO::FETCH_CLASS, Post::class);

foreach ($postsCat as $value) {
    $array[] += $value->post_id;
}

$sql3 = "SELECT * FROM category WHERE id =?";
$state3 = $pdo->prepare($sql3);
$state3->execute([$id]);
$state3->setFetchMode(PDO::FETCH_CLASS, Post::class);
$categ = $state3->fetch();
$title = $categ->getName();

?>

<div>
    <?php
    foreach ($array as $value) :
        $sql2 = "SELECT * FROM post WHERE id =?";
        $state2 = $pdo->prepare($sql2);
        $state2->execute([$value]);
        $state2->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $post = $state2->fetch();
    ?>
        <article class="row col-3 m-2 d-flex flex-column">
            <div class="d-flex flex-column border">
                <h2 class="card-title"><span class="text-secondary"><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
                <p class="card-text"><?= Text::excerpt($post->getContent(), 200); ?></p>
                <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>" class="text-center pb-2">lire plus</a>
            </div>
            <p class="card-footer text-muted"> <?= $post->getCreatedAt(); ?></p>
        </article>
    <?php endforeach; ?>
</div>
