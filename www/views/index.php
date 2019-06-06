<?php
use App\Model\Post;
use App\Helpers\Text;

try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
//$pdo = new PDO("mysql:dbname=blog;host=".getenv('MYSQL_HOST');"charset=UTF8", getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));

$nbPost = $pdo->query("SELECT COUNT(id) FROM post")->fetch()[0];
$perPage = 12;
$nbPage = ceil($nbPost / $perPage);

if ((int)$_GET['page'] > $nbPage) {
    header('location: /');
    exit();
}

if (isset($_GET['page'])) {
    $currentPage = (int)$_GET['page'];
}else{
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $perPage;
$posts = $pdo->query("SELECT * FROM post ORDER BY id LIMIT {$offset}, {$perPage}")->fetchAll(PDO::FETCH_CLASS, Post::class);
//dd($posts);
$title = "Home";

/**
 * 
 * $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()])
 * <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>" class="text-center pb-2">lire plus</a>
 * <a href="/article/<?= $post->getSlug() ?>-<?= $post->getId() ?>" class="text-center pb-2">lire plus</a>
 */

?>
    <section class="articles">
<?php foreach($posts as $post): ?>
        <article class="">
            <div class="">
                <h2 class=""><span class=""><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
                <p class=""><?= Text::excerpt($post->getContent(), 200); ?></p>
                <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>">lire plus</a>
            </div>
            <p> <?= $post->getCreatedAt(); ?></p>
        </article>
<?php endforeach; ?>
    </section>
    <nav class="page navigation">
        <ul class="pagination">
        <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
            <?php $class = $currentpage == $i ? " active" : ""; ?>
            <?php $uri = $i == 1 ? "" : "?page=" . $i; ?>
            <li><a href="/<?= $uri ?>"><?= $i ?></a></li>
        <?php endfor ?>
        </ul>
    </nav>