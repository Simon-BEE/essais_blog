<?php
use App\Model\{Post, Category};
use App\Connection;

$pdo = Connection::getPDO();
$id = (int)$params['id'];
$slug = $params['slug'];

$sql = "SELECT * FROM post WHERE id = ?";
$state = $pdo->prepare($sql);
$state->execute([$id]);
$state->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */
$post = $state->fetch();

if (!$post) {
    throw new Exception('Aucun article ne correspond à cet Id !');
}

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['id' => $id, 'slug' => $post->getSlug()]);
    http_response_code(301);
    header('location: '.$url);
    exit();
}

$categories = \App\CategoriesQuery::queryCategories($post->getId());
$title = "article : " . $post->getName();

?>

<section class="post seeking">
    <article class="card">
        <h2 class="card-title text-center"><?= $post->getName(); ?></h2>
        <div class="post-content">
            <div class="post-cat">
                <p>
    <?php foreach ($categories as $key => $category) :
        if ($key > 0) { echo ', '; }
        $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    ?>
        <a href="<?= $category_url ?>"><?=substr($category->getName(),0,-1)?></a>
    <?php endforeach; ?>
                </p>
            </div>
            <p class="card-text"><?= $post->getContent(); ?></p>
            <p class="card-footer"><?= $post->getCreatedAt(); ?></p>
        </div>
    </article>
</section>
