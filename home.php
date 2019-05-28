<?php
require_once 'vendor/autoload.php';
$pdo = new PDO('mysql:dbname=blog;host=172.17.0.2;charset=UTF8', 'userblog', 'blogpwd');

$req = "SELECT COUNT(*) FROM post";
$step = $pdo->prepare($req);
$step->execute();
$count = $step->fetch();
$total = $count[0]/10;

if($_GET['page'] > $total || !ctype_digit($_GET['page'])){
    $message = 'Page introuvable !';
}else{
    $message = '';
    unset($message);
}

if (isset($_GET['page']) && $_GET['page'] <= $total && ctype_digit($_GET['page'])) {
    $get = $_GET['page'] - 1;
    $sql = "SELECT * FROM post LIMIT 10 OFFSET ".$get."0";
}else{
    $sql = "SELECT * FROM post LIMIT 10";
}
$state = $pdo->prepare($sql);
$result1 = $state->execute();
$result2 = $state->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenue sur mon blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="">
        <h1>Bienvenue</h1>
    </header>
    <div class="alert"><?= $message ?></div>
    <section class="articles">
<?php foreach($result2 as $result): ?>
        <article>
            <h2><?= $result['id']." | ".$result['name']; ?></h2>
            <p ><?= $result['content']; ?></p>
            <p><?= $result['created_at']; ?></p>
        </article>
<?php endforeach; ?>
    </section>
    <section class="pagination">
        <p class="pages">
            <a href="/">1</a>
<?php for ($i=2; $i <= ($count[0]/10); $i++):?>
            <a href="/?page=<?= $i ?>"><?= $i ?></a>
<?php endfor; ?>
        </p>
    </section>
    <footer>
        <p>Merci !</p>
    </footer>
</body>
</html>