<section class="home-listing">
	<h4>Reset password</h4>
	<div class="form">
		<form action="<?php URL::to('/reset?token=' . $token); ?>" method="POST">
			<?php if(isset($message)){
			?>
				<h4 class="form-error"><?php echo $message; ?></h4>
			<?php
			} ?>
			<div class="form-group">
				<label class="form-label" for="password">Password</label>
				<input class="form-input" type="password" name="password" id="password" placeholder="Password">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password2">Repeat Password</label>
				<input class="form-input" type="password" name="password2" id="password2" placeholder="Repeat Password">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password">&nbsp;</label>
				<button type="submit">Reset password</button>
				<div class="clear-float"></div>
			</div>
		</form>
	</div>
</section>

<script>
	document.getElementById("signup-link").className = "active";
</script>
