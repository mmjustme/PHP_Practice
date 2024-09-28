<?php require VIEWS . '/incs/header.php' ?>

<main class="main py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Post</h1>
                <form action="/posts" method="post">

                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Post Title"
                            value="<?= old("title") ?>">

                        <?= isset($validtion) ? $validtion->listErrors("title") : ''; ?>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <input name="excerpt" type="text" class="form-control" id="excerpt" placeholder="Post Excerpt"
                            rows="3" value="<?= old("excerpt") ?>">

                        <?= isset($validtion) ? $validtion->listErrors("excerpt") : ''; ?>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" type="text" class="form-control" id="content"
                            placeholder="Post Content" rows="5"><?= old("content") ?></textarea>

                        <?= isset($validtion) ? $validtion->listErrors("content") : ''; ?>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?php require VIEWS . '/incs/footer.php' ?>