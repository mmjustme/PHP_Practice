<?php require VIEWS . '/incs/header.php' ?>

	<main class="main py-3">

		<div class="container">
			<div class="row">
				<div class="col-md-4 m-auto">
					<h1>Register Page</h1>
					<form action="/register" method="post">

						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input name="name" type="text" class="form-control" id="name" placeholder="Name"
										 value="<?= old("name") ?>">

              <?= isset($validation) ? $validation->listErrors("name") : ''; ?>
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input name="email" type="email" class="form-control" id="email" placeholder="Email"
										 rows="3" value="<?= old("email") ?>">

              <?= isset($validation) ? $validation->listErrors("email") : ''; ?>
						</div>

						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input name="password" type="password" class="form-control" id="password" placeholder="Password"
										 rows="3" value="<?= old("password") ?>">

              <?= isset($validation) ? $validation->listErrors("password") : ''; ?>
						</div>


						<div class="mb-3">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</form>
				</div>

			</div>
		</div>

	</main>

<?php require VIEWS . '/incs/footer.php' ?>