<section class="home-listing">
	<h4>Users</h4>
	<div class="users">
		<?php foreach($users as $user){ ?>
			<div class="user">
				<div class="avatar">
					<img src="<?php URL::to('/public/img/avatar/' . $user['avatar']); ?>" alt="">
				</div>
				<a href="<?php URL::to('/profile?id=' . $user['id']); ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
			</div>
		<?php } ?>
	</div>
</section>

<script>
	document.getElementById("users-link").className = "active";
</script>
