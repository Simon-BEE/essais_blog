<?php
//dd($_ENV);
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
$posts = $pdo->query("SELECT * FROM post ORDER BY id LIMIT {$offset}, {$perPage}")->fetchAll(PDO::FETCH_CLASS, App\Post::class);

$title = "Home";


?>
    <section class="articles bg-light mb-2 mt-3 p-5 d-flex flex-wrap align-items-strech justify-content-center row">
<?php foreach($posts as $post): ?>
        <article class="row col-3 m-2 d-flex flex-column">
            <div class="d-flex flex-column border">
                <h2 class="card-title"><span class="text-secondary"><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
                <p class="card-text"><?= substr($post->getContent(), 0, 200); ?></p>
                <a href="/article/<?= $post->getSlug() ?>-<?= $post->getId() ?>" class="text-center pb-2">lire plus</a>
            </div>
            <p class="card-footer text-muted"> <?= $post->getCreatedAt(); ?></p>
        </article>
<?php endforeach; ?>
    </section>
    <nav class="page navigation">
        <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
            <?php $class = $currentpage == $i ? " active" : ""; ?>
            <?php $uri = $i == 1 ? "" : "?page=" . $i; ?>
            <li class="page-item<?= $class ?>"><a class="page-link" href="/<?= $uri ?>"><?= $i ?></a></li>
        <?php endfor ?>
        </ul>
    </nav>

    