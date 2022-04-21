<div class="container">
    <div class="row">
        <div class="col">
            <h2>Commentaires :</h2>
            <?php include '../template/partials/_comment-form.html.php' ?>
            <?php foreach ($comments as $comment) : ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $comment->getAuthor() ?> le <?= $comment->getCreated_at()->format('d/m/Y à H:i') ?> :</h5>
                        <p class="card-text"><?= $comment->getContent() ?></p>
                        <a href="" class="btn btn-secondary">Répondre</a>
                        <form action="/blog/delcomment" method="post">
                            <input type="hidden" name="id" value="<?= $comment->getId() ?>">
                            <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
                            <input type="submit" name="submit" onclick="return confirm('Voulez-vous supprimer le commentaire de <?= $comment->getAuthor() ?> du <?= $comment->getCreated_at()->format('d/m/Y à H:i') ?>')" class="btn btn-danger" value="Supprimer">
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>