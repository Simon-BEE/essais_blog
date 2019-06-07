<article class="">
    <div class="">
        <h2 class=""><span class=""><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
        <p class=""><?= $post->getExcerpt(200)?></p>
        <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>">lire plus</a>
    </div>
    <p> <?= $post->getCreatedAt(); ?></p>
</article>