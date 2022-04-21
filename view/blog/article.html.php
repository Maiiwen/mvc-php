<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center"><?= $article['title'] ?></h1>
            <p><?= $article['content'] ?></p>
        </div>
    </div>
</div>


<?php include '../view/partials/_comment-list.html.php' ?>