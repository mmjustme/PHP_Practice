<?php require_once "../app/views/incs/header.php" ?>

	<main class="main py-3">
		<div class="container">
			<div class="row">
        <?= $pagination ?>
				<div class="col-md-8">
          <?php foreach ($posts as $post): ?>
						<div class="card mb-3">

							<div class="card-body">
								<h5 class="card-title">
									<a href="posts?id=<?= $post['id'] ?>">
                    <?= h($post['title']); ?>
									</a>

								</h5>
								<p class="card-text">
                  <?= $post['excerpt']; ?>
								</p>
								<a href="posts?id=<?= $post['id'] ?>">Go somewhere</a>
							</div>

						</div>
          <?php endforeach ?>
          <?= $pagination ?>

				</div>
        <?php require_once "../app/views/incs/sidebar.php" ?>
			</div>
		</div>

	</main>

<?php require_once "../app/views/incs/footer.php" ?>