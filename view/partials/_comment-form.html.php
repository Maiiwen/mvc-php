<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Ajouter un commentaire
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <form action="/?controller=blog&action=comment" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="author" id="author" maxlength="64" class="form-control" placeholder="Nom" required>
                        <label for="author">Votre nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="content" id="content" maxlength="255" class="form-control" placeholder="Commentaire" required>

                        <label for="content">Votre commentaire</label>
                    </div>
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    <input type="submit" class="btn btn-lg btn-primary" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
</div>