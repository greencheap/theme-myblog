<?php $view->script("post", "blog:app/bundle/post.js", "vue"); ?>
<?php
$theme_blog = $app["theme_blog"];
$theme_blog->instanceBlogId($post->id);
$previousPost = $theme_blog->getPreviousPost();
$lastPost = $theme_blog->getlastPost();
?>
<article class="uk-article">
    <div class="uk-container uk-container-xsmall">
        <div class="uk-margin uk-flex uk-flex-middle uk-flex-between">
            <div>
                <p class="uk-text-meta">
                    <?= __("Written by %name% on %date%", ["%name%" => $this->escape($post->user->name), "%date%" => '<time datetime="' . $post->date->format(\DateTime::ATOM) . '" v-cloak>{{ "' . $post->date->format(\DateTime::ATOM) . '" | date("longDate") }}</time>']) ?>
                </p>
            </div>
            <div>
                <ul class="uk-subnav uk-text-capitalize">
                    <?php foreach ($post->getCategories() as $category): ?>
                        <li><a href="<?= $view->url("@blog/category/id", ["id" => $category["id"]]) ?>">#<?= $category["title"] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    
        <h1 class="uk-heading-small uk-text-bold uk-margin"><a class="uk-link-reset" href="<?= $view->url("@blog/id", ["id" => $post->id]) ?>"><?= $post->title ?></a></h1>

        <?php if ($post->excerpt): ?>
            <div class="uk-margin tm-text"><?= $post->excerpt ?></div>
        <?php endif; ?>
    </div>

    <?php if ($image = $post->get("image.src")): ?>
        <a class="uk-display-block uk-margin-large" href="<?= $view->url("@blog/id", ["id" => $post->id]) ?>"><img src="<?= $image ?>" alt="<?= $post->get("image.alt") ?>" width="100%"></a>
    <?php endif; ?>

    <div class="uk-container uk-container-xsmall uk-margin">
        <div class="uk-margin tm-text"><?= $post->content ?></div>

        <div class="uk-margin-large uk-child-width-1-2@m" uk-grid>
            <div>
            <?php if ($previousPost): ?>
                <a href="<?= $view->url("@blog/id", ["id" => $previousPost->id ?: 0], "base") ?>" class="uk-link-reset uk-card uk-card-primary uk-light uk-card-body uk-card-small">
                    <span class="uk-display-block"><i uk-icon="arrow-left" class="uk-margin-small-right"></i><?= __("Previous Post") ?></span>
                    <p class="uk-text-small uk-text-muted uk-margin-small">
                    <?= $previousPost->title ?>
                    </p>
                </a>
                <?php endif; ?>
            </div>
            <div>
            <?php if ($lastPost): ?>
                <a href="<?= $view->url("@blog/id", ["id" => $lastPost->id ?: 0], "base") ?>" class="uk-link-reset uk-card uk-card-primary uk-light uk-card-body uk-card-small">
                    <span class="uk-display-block uk-text-right"><?= __("Last Post") ?><i uk-icon="arrow-right" class="uk-margin-small-left"></i></span>
                    <p class="uk-text-right uk-text-small uk-text-muted uk-margin-small">
                    <?= $lastPost->title ?>
                    </p>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($post->get("comment_status")): ?>
            <?= $view->render("system/comment/comment.php", [
                "service" => [
                    "type" => "blog",
                    "own_id" => $post->id,
                    "type_url" => [
                        "url" => "@blog/id",
                        "key" => "id",
                    ],
                ],
            ]) ?>
        <?php endif; ?>
        
    </div>

</article>