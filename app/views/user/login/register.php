<section class="home-listing">
	<h4>Register</h4>
	<div class="form">
		<form action="<?php URL::to('/register'); ?>" method="POST">
			<?php if(isset($message)){
			?>
				<h4 class="form-error"><?php echo $message; ?></h4>
			<?php
			} ?>
			<div class="form-group">
				<label class="form-label" for="first_name">First name</label>
				<input class="form-input" type="text" name="first_name" id="first_name" placeholder="First name" value="<?php if (isset($input['first_name'])) echo $input['first_name']; ?>">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="last_name">Last name</label>
				<input class="form-input" type="text" name="last_name" id="last_name" placeholder="Last name" value="<?php if (isset($input['last_name'])) echo $input['last_name']; ?>">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="email">Email</label>
				<input class="form-input" type="text" name="email" id="email" placeholder="Email" value="<?php if (isset($input['email'])) echo $input['email']; ?>">
				<div class="clear-float"></div>
			</div>
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
				<label class="form-label" for="gender">Gender</label>
				<input type="radio" name="gender" id="male" value="1">
				<label for="male">Male</label>
				<input type="radio" name="gender" id="female" value="2">
				<label for="female">Female</label>
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password">&nbsp;</label>
				<button type="submit">Register</button>
				<div class="clear-float"></div>
			</div>
		</form>
	</div>
</section>

<script>
	document.getElementById("signup-link").className = "active";
</script>
