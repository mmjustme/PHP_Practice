<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- base додає свій шлях перед кожним відносним посиланням на файл -->
	<!-- assets/main.css буде  http://localhost/PHP_Practice/assets/main.css-->
	<base href="<?= PATH ?>/">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/main.css">
	<title><?= $title ?? "Title" ?></title>
</head>

<body>

<div class="wrapper">

	<header class="header">

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class=" container-fluid">
				<a class="navbar-brand" href="#">Navbar</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
								data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
								aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/about">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="posts/create">New Post</a>
						</li>
					</ul>

					<ul class="navbar-nav">
            <?php if (isset($_SESSION['user'])): ?>
							<a class="navbar-brand d-none d-lg-block">
								<img src="<?= $_SESSION['user']['avatar'] ?>" alt="avatar"
										 style="height: 35px; width:35px; border-radius: 50%; object-fit: cover">
							</a>
							<li class="nav-item">
								<a class="nav-link"><?= $_SESSION['user']['name']; ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/logout">Logout</a>
							</li>
            <?php else: ?>
							<li class="nav-item">
								<a class="nav-link" href="/login">Login</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/register">Register</a>
							</li>
            <?php endif ?>
					</ul>


				</div>
			</div>
		</nav>

	</header>
<?php get_alerts() ?>