<h1>Blog</h1>
<div class="container">
    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['title'] ?></h5>
                        <p class="card-text"><?= strlen($article['content']) > 100 ? substr(strip_tags($article['content']), 0,  100) . "..." : $article['content'] ?></p>
                        <a href="/?controller=blog&action=article&id=<?= $article['id'] ?>" class="btn btn-primary">Voir plus -></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>