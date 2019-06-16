<article class="unique">
    <h2 class=""><span class=""><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
    <div class="inside">
        <p class="time"><?= $post->getCreatedAt('d/m'); ?></p>
        <aside class="post-aside">
            <p class="post-text"><?= $post->getExcerpt(200)?></p>
            <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>">lire plus</a>
        </aside>
    </div>
    <div class="index-cat">
        <p>
    <?php foreach ($post->getCategories() as $key => $category) :
        if ($key > 0) { echo ', '; }
        $category_url = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
    ?>
        <a href="<?= $category_url ?>"><?=substr($category->getName(),0,-1)?></a>
    <?php endforeach; ?>
        </p>
    </div>
</article>