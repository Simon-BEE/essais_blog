<?php
/**
 * fichier qui génère la vue pour l'url /category/[i:id]
 * 
 */

try {
    $pdo = new PDO("mysql:dbname=blog;charset=UTF8;host=".getenv('MYSQL_HOST'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$id = (int)$params['id'];
$slug = $params['slug'];

$sql = "SELECT * FROM post_category";
$state = $pdo->prepare($sql);
$state->execute();
$post = $state->fetch(PDO::FETCH_OBJ);
dd($post);
$title = "test";

?>

<p></p>