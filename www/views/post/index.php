<?php
use App\Model\{Post, Category};
use App\PaginatedQuery;
use App\Connection;

$url = $router->url("home");

$paginatedQuery = new App\PaginatedQuery(
    "SELECT COUNT(id) FROM post", 
    "SELECT * FROM post ORDER BY id",
    Post::class,
    $url
);
$posts = $paginatedQuery->getItems();

$ids = array_map(function (Post $post) {
    return $post->getId();
}, $posts);

$categories = Connection::getPDO()
->query("SELECT c.*, pc.post_id
        FROM post_category pc
        LEFT JOIN category c ON pc.category_id = c.id
        WHERE post_id IN (" . implode(', ', $ids) . ")")
->fetchAll(\PDO::FETCH_CLASS, Category::class);

$postsById = [];
foreach ($posts as $post) {
    $postsById[$post->getId()] = $post;
}
foreach ($categories as $category) {
    $postsById[$category->post_id]->setCategories($category);
}

$title = "Home";
?>

    <section class="articles seeking">
<?php foreach($postsById as $post){
        require 'card.php';
} ?>
</section>

<?php echo $paginatedQuery->getNavHtml(); ?>