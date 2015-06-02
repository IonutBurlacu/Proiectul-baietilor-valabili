<section class="home-listing">
	<h4>Forgot password</h4>
	<div class="form">
		<form action="<?php URL::to('/forgot') ?>" method="POST">
			<?php if(isset($message)){ ?>
				<h4 class="form-error"><?php echo $message; ?></h4>
			<?php } ?>
			<div class="form-group">
				<label class="form-label" for="email">Email</label>
				<input class="form-input" type="text" name="email" id="email" placeholder="Email">
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
