<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center"><?= $article->getTitle() ?></h1>
            <div class="d-flex justify-content-between">
                <a href="/blog/edit/<?= $article->getId() ?>" class="btn btn-secondary">Modifier</a>
                <p class="text-end">Publié le <?= $article->getCreated_at()->format('d/m/Y à H:i') ?></p>
            </div>

            <p><?= $article->getContent() ?></p>
        </div>
    </div>
</div>


<?php include '../template/partials/_comment-list.html.php' ?>