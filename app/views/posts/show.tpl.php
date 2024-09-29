<?php require VIEWS . '/incs/header.php' ?>

<main class="main py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= h($post["title"]) ?></h1>
                <?= $post["content"] ?>

                <form action="/posts" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <button class="btn btn-link">Delete Post</button>
                </form>
            </div>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>