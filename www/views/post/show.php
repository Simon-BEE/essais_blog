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

$query = $pdo->prepare("SELECT c.id, c.slug, c.name FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id = :id");
$query->execute([':id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category[] */
$categories = $query->fetchAll();
$title = "article : " . $post->getName();

?>

<section class="post">
    <article class="card">
        <h1 class="card-title text-center"><?= $title; ?></h1>
<?php foreach ($categories as $key => $category) :
    if ($key > 0) { echo ', '; }
    $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
?>
    <a href="<?= $category_url ?>"><?= $category->getName() ?></a>
<?php endforeach; ?>
        <p class="card-text"><?= $post->getContent(); ?></p>
        <p class="card-footer"><?= $post->getCreatedAt(); ?></p>
    </article>
</section>
