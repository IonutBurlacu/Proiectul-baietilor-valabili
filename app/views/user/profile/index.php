<section class="home-listing">
	<h4><?php echo $user['first_name'] . " " . $user['last_name']; ?></h4>
	<article class="profile">
		<div class="left-side">
			<img src="<?php URL::to('/public/img/avatar/' . $user['avatar']); ?>" alt="">
			<button id="choose-file" onclick="openFileDialog()">Change avatar</button>
			<input type="file" id="file-dialog" style="display:none;">
			<button id="save-file">Save</button>
			<button id="cancel-file">Cancel</button>
		</div>
	</article>
</section>

<script>
	document.getElementById("profile-link").className = "active";
</script>
