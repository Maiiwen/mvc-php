<div class="container">
    <div class="row">
        <div class="col">
            <h2>Commentaires :</h2>
            <?php include '../view/partials/_comment-form.html.php' ?>
            <?php foreach ($comments as $comment) : ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $comment['author'] ?> :</h5>
                        <p class="card-text"><?= $comment['content'] ?></p>
                        <a href="" class="btn btn-secondary">Répondre</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>