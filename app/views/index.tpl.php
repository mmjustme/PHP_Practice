<?php require_once "../app/views/incs/header.php" ?>

<main class="main py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($posts as $post): ?>
                    <div class="card mb-3">

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="post?id=<?= $post['id'] ?>">
                                    <?= $post['title']; ?>
                                </a>

                            </h5>
                            <p class="card-text">
                                <?= $post['excerpt']; ?>
                            </p>
                            <a href="post?id=<?= $post['id'] ?>">Go somewhere</a>
                        </div>

                    </div>
                <?php endforeach ?>


            </div>
            <?php require_once "../app/views/incs/sidebar.php" ?>
        </div>
    </div>

</main>

<?php require_once "../app/views/incs/footer.php" ?>