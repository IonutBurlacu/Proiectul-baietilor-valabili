<html>
	<head>
		<title>Home page</title>

		<!-- CSS -->
		<link rel="stylesheet" href="/public/css/style.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

		<script>
			
		</script>
	</head>
	<body onload="calculateAvatarSize()">
		<main>
			<header>
				<div class="top">
					<h3 class="logo">Adwise</h3>
					<nav>
						<a href="#" class="active">Questions</a>
						<a href="#">Users</a>
						<a href="#">Login</a>
						<a href="#">Sign up</a>
					</nav>
					<div class="clear-float"></div>
				</div>
				<div class="search-bar">
					<form action="" action="get">
						<input type="text" class="search-bar-input" placeholder="Search...">
						<button type="submit">
							<img src="/public/img/search-icon.png" alt="">
						</button>
					</form>
				</div>
			</header>
			<section class="home-categories">
				<h4>Categories</h4>
				<ul class="categories">
					<li>
						<a href="">Arts & Humanities</a>
					</li>
					<li>
						<a href="">Beauty & Style</a>
					</li>
					<li>
						<a href="">Business & Finance</a>
					</li>
					<li>
						<a href="">Cars & Transportation</a>
					</li>
					<li>
						<a href="">Computers & Internet</a>
					</li>
					<li>
						<a href="">Entertainment & Music</a>
					</li>
					<li>
						<a href="">Environment</a>
					</li>
					<li>
						<a href="">Food & Drink</a>
					</li>
					<li>
						<a href="">Pets</a>
					</li>
					<li>
						<a href="">Science & Mathematics</a>
					</li>
					<li>
						<a href="">Society & Culture</a>
					</li>
					<li>
						<a href="">Sports</a>
					</li>
					<li>
						<a href="">Travel</a>
					</li>
				</ul>
			</section>
			<?php echo $content; ?>
			<footer>
				
			</footer>
		</main>

		<!-- JS -->
		<script type="text/javascript" src="public/js/script.js"></script>
	</body>
</html>