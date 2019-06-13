<?php
use App\Model\Post;
use App\Helpers\Text;
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

$title = "Home";

?>

    <section class="articles seeking">
<?php foreach($posts as $post){
    require 'card.php';
} ?>
</section>

<?php echo $paginatedQuery->getNavHtml(); ?>