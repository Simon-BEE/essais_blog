<?php
use App\Model\{Post, Category};
use App\Connection;
use App\PaginatedQuery;

$pdo = Connection::getPDO();
$id = (int)$params['id'];
$slug = $params['slug'];

$statement = $pdo->prepare("SELECT * FROM category WHERE id =?");
$statement->execute([$id]);
$statement->setFetchMode(PDO::FETCH_CLASS, Category::class);
$category = $statement->fetch();

if (!$category) {
    throw new Exception('Aucune catégorie ne correspond à cet Id !');
}

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
    http_response_code(301);
    header('location: '.$url);
    exit();
}

$title = "Category : ".$category->getName();

$url = $router->url("category", ["id" => $category->getId(), "slug" => $category->getSlug()]);
$paginatedQuery = new App\PaginatedQuery(
    "SELECT count(category_id) FROM post_category WHERE category_id = {$category->getId()}", 
    "SELECT p.*
        FROM post p
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id = {$category->getId()}
        ORDER BY created_at DESC",
    Post::class,
    $url,
    6
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
    //dd($postsById);
    $postsById[$category->post_id]->setCategories($category);
}
?>

<section class="articles">
<?php foreach($postsById as $post){
    require dirname(__dir__).'/post/card.php';
} ?>
</section>

<?php echo $paginatedQuery->getNavHtml(); ?>
