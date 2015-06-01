<html>
	<head>
		<title>Adwise</title>

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
					<h3 class="logo"><a href="<?php URL::to('/'); ?>">Adwise</a></h3>
					<nav>
						<a href="<?php URL::to('/'); ?>" id="questions-link">Latest Questions</a>
						<a href="<?php URL::to('/users'); ?>" id="users-link">Users</a>
						<?php 
							if(Auth::check()){
								?>
									<a href="<?php URL::to('/profile?id=' . Auth::getUserId()) ?>" id="profile-link">Profile</a>
									<a href="<?php URL::to('/ask') ?>" id="ask-link">Ask a question</a>
									<a href="<?php URL::to('/logout') ?>" id="ask-link">Logout</a>
								<?php
							}
							else {
								?>
									<a href="<?php URL::to('/login') ?>" id="login-link">Login</a>
									<a href="<?php URL::to('/register') ?>" id="signup-link">Sign up</a>
								<?php
							}
						 ?>
					</nav>
					<div class="clear-float"></div>
				</div>
				<div class="search-bar">
					<form action="<?php URL::to('/search'); ?>" method="GET">
						<input type="text" class="search-bar-input" placeholder="Search..." name="query">
						<button type="submit">
							<img src="/public/img/search-icon.png" alt="">
						</button>
					</form>
				</div>
			</header>
			<section class="home-categories">
				<h4>Categories</h4>
				<ul class="categories">
					<?php 
						foreach($categories as $cat){
							echo "<li><a href='http://bucium.mobiletouch.ro:6010/category?id=" 
							. $cat['id'] 
							. "'>" 
							. $cat['title'] 
							. "</a></li>";
						}
					 ?>
				</ul>
			</section>