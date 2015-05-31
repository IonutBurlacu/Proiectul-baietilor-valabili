<section class="home-listing">
	<h4><?php echo $user['first_name'] . " " . $user['last_name']; ?></h4>
	<article class="profile">
		<div class="left-side">
			<div class="avatar">
				<img id="user-avatar" src="<?php URL::to('/public/img/avatar/' . $user['avatar']); ?>" alt="">
			</div>
			<?php if($user['id'] == Auth::getUserId()){ ?>
				<span class="user-id" id="<?php echo Auth::getUserId(); ?>"></span>
				<button id="choose-file" onclick="openFileDialog()">Change avatar</button>
				<input type="file" id="file-dialog" style="display:none;">
				<button id="save-file" class="hidden">Save</button>
				<button id="cancel-file" class="hidden">Cancel</button>
				<a id="edit-profile" href="<?php URL::to('/profile/edit?id=' . $user['id']); ?>">Edit profile</a>
			<?php } ?>
		</div>
		<div class="right-side">
			<h4 style="margin-top:0px">Email: <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></h4>
			<h4>Phone: <?php if($user['phone'] != "") {echo $user['phone'];} else {echo "Not set";} ?></h4>
			<h4>Gender: <?php if($user['gender'] == 1) { echo "Male"; } else { echo "Female"; } ?></h4>
			<h4>Interests: <?php if(count($user['interests']) == 0) {echo "No interests"; } else { for($i = 0; $i < count($user['interests']) - 1; $i++) {echo $user['interests'][$i]['title'] . ", ";} echo $user['interests'][count($user['interests']) - 1]['title']; } ?></h4>
			<h4>Questions: <?php echo $user['question_count']; ?></h4>
			<h4>Answers: <?php echo $user['answer_count']; ?></h4>
		</div>
		<div class="clear-float"></div>
	</article>
	<h4>Badges</h4>
	<article class="badges">
		<?php if(count($user['badges']) == 0) { echo "<p>No badges</p>";} else { for($i = 0; $i < count($user['badges']); $i++){ ?>
			<ul>
				<li><?php echo "<span>" . $user['badges'][$i]['title'] . "</span> (" . $user['badges'][$i]['description'] . ")"; ?></li>
			</ul>
		<?php }} ?>
	</article>
</section>

<script>
	document.getElementById("profile-link").className = "active";
</script>
