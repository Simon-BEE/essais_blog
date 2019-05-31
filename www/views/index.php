<?php
$pdo = new PDO('mysql:dbname=blog;host=blog.mysql;charset=UTF8', 'userblog', 'blogpwd');

$count = $pdo->query("SELECT COUNT(id) FROM post")->fetch()[0]/10;
if(null !== $_GET['page'] && intval($_GET['page'] > 0 && $_GET['page'] < $count)){
    $start = 10*$_GET['page'] -10;
}else{
    $start = 0;
}
$rec = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT 10 OFFSET {$start}");
$result2 = $rec->fetchAll();

$title = "home";
?>
    <section class="articles">
<?php foreach($result2 as $result): ?>
        <article>
            <h2><span><?= $result['id']." |</span> ".$result['name']; ?></h2>
            <p ><?= $result['content']; ?></p>
            <p><?= $result['created_at']; ?></p>
        </article>
<?php endforeach; ?>
    </section>
    <section class="pagination">
        <p class="pages">
            <a href="/">1</a>
            <?php for ($i=2; $i <= $count; $i++):?>
            <a href="/?page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
        </p>
    </section>