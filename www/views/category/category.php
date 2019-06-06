<?php
use App\Model\{Post, Category};
use App\Helpers\Text;
use App\Connection;

$pdo = Connection::getPDO();

$id = (int)$params['id'];
$slug = $params['slug'];

$query = $pdo->prepare('
SELECT p.id, p.name, p.slug, p.content, p.created_at
FROM post_category pc
JOIN post p ON pc.post_id = p.id
WHERE pc.category_id = :id
');
$query->execute([':id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Category[] */
$posts = $query->fetchAll();

if (!$posts) {
    throw new Exception('Aucune catégorie ne correspond à cet Id !');
}

$sql3 = "SELECT * FROM category WHERE id =?";
$state3 = $pdo->prepare($sql3);
$state3->execute([$id]);
$state3->setFetchMode(PDO::FETCH_CLASS, Post::class);
$categ = $state3->fetch();
$title = "Category : ".$categ->getName();

if ($categ->getSlug() !== $slug) {
    $url = $router->url('category', ['id' => $id, 'slug' => $categ->getSlug()]);
    http_response_code(301);
    header('location: '.$url);
    exit();
}

//dd($posts);
?>

<section class="articles">
    <?php
    foreach ($posts as $post) : ?>
        <article>
            <div>
                <h2><span><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
                <p><?= Text::excerpt($post->getContent(), 200); ?></p>
                <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>">lire plus</a>
            </div>
            <p> <?= $post->getCreatedAt(); ?></p>
        </article>
    <?php endforeach; ?>
</section>

