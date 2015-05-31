<section class="home-listing">
	<h4>Edit</h4>
	<div class="form">
		<form action="<?php URL::to('/profile/edit'); ?>" method="POST">
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
				<label class="form-label" for="phone">Phone</label>
				<input class="form-input" type="text" name="phone" id="phone" placeholder="Phone">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="interests">Interests</label>
				<?php foreach($interests as $interest){ ?>
					<?php if(in_array($interest['id'], $input['interests'])){ ?>
						<input name="interests[]" type="checkbox" checked id="<?php echo $interest['id']; ?>" value="<?php echo $interest['id']; ?>">
						<label for="<?php echo $interest['id']; ?>"><?php echo $interest['title']; ?></label>
					<?php } else { ?>
						<input name="interests[]" type="checkbox" id="<?php echo $interest['id']; ?>" value="<?php echo $interest['id']; ?>">
						<label for="<?php echo $interest['id']; ?>"><?php echo $interest['title']; ?></label>
					<?php } ?>
				<?php } ?>
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password">&nbsp;</label>
				<button type="submit">Save</button>
				<div class="clear-float"></div>
			</div>
		</form>
	</div>
</section>

<script>
	document.getElementById("profile-link").className = "active";
</script>
