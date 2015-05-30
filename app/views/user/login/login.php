<section class="home-listing">
	<h4>Login</h4>
	<div class="form">
		<form action="http://bucium.mobiletouch.ro:6010/login" method="POST">
			<?php if(isset($message)){
			?>
				<h4 class="form-error"><?php echo $message; ?></h4>
			<?php
			} ?>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" placeholder="Email">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Password">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label for="password">&nbsp;</label>
				<button type="submit">Login</button>
				<a href="http://bucium.mobiletouch.ro:6010/forgot">Forgot your password?</a>
				<div class="clear-float"></div>
			</div>
		</form>
	</div>
</section>

<script>
	document.getElementById("login-link").className = "active";
</script>
