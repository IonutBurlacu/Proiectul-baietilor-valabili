<section class="home-listing">
	<h4>Login</h4>
	<div class="form">
		<form action="<?php URL::to('/login') ?>" method="POST">
			<?php if(isset($message)){ ?>
				<h4 class="form-error"><?php echo $message; ?></h4>
			<?php } ?>
			<div class="form-group">
				<label class="form-label" for="email">Email</label>
				<input class="form-input" type="text" name="email" id="email" placeholder="Email">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password">Password</label>
				<input class="form-input" type="password" name="password" id="password" placeholder="Password">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password">&nbsp;</label>
				<button type="submit">Login</button>
				<a href="<?php URL::to('/forgot'); ?>">Forgot your password?</a>
				<div class="clear-float"></div>
			</div>
		</form>
	</div>
</section>

<script>
	document.getElementById("login-link").className = "active";
</script>
