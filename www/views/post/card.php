<article>
<h2 class=""><span class=""><?= $post->getId()." |</span> ".substr($post->getName(),0,20); ?></h2>
    <div class="inside">
        <p class="time"><?= $post->getCreatedAt('d/m'); ?></p>
        <aside class="post-aside">
            <p class="post-text"><?= $post->getExcerpt(200)?></p>
            <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>">lire plus</a>
        </aside>
    </div>
</article>