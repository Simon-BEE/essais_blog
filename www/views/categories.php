<?php
/**
 * fichier qui génère la vue pour l'url /categories
 * 
 */
try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
$post = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_OBJ);

//dd($post);


$title = "Catégories";
?>

<ul>
<?php foreach ($post as $value): ?>
    <li><a href="/category/<?= $value->slug ?>-<?= $value->id ?>"><?= $value->name; ?></a></li>
<?php endforeach; ?>
</ul> 