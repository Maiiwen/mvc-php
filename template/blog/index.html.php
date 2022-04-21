<h1>Blog</h1>
<div class="container">
    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->getTitle() ?></h5>
                        <p class="card-text"><?= strlen($article->getContent()) > 100 ? substr(strip_tags($article->getContent()), 0,  100) . "..." : $article->getContent() ?></p>
                        <a href="/blog/article/<?= $article->getId() ?>" class="btn btn-primary">Voir plus -></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>