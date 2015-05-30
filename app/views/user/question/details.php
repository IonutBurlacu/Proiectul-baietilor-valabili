<section class="question-details">
	<h4><?php echo $question['title']; ?></h4>
	<article class="content">
		<aside class="left-side">
			<div class="avatar">
				<img src="/public/img/avatar.jpg" alt="">
			</div>
			<a href="" class="profile-name"><?php echo $question['first_name'] . " " . $question['last_name']; ?></a>
			<div class="vote">
				<img src="public/img/up-arrow.png" alt="" class="arrow">
				<p><?php echo $question['votes']; ?></p>
				<img src="public/img/down-arrow.png" alt="" class="arrow">
			</div>
		</aside>
		<aside class="right-side">
			<div class="description">
				<?php echo $question['content']; ?>
			</div>
			<p class="posted">asked on <?php echo date("M d \a\\t H:i", strtotime($question['created_at'])); ?></p>
			<?php if($_SESSION['user_id'] == $question['user_id']) { ?>
				<a href="<?php URL::to('/question/delete?id=' . $question['question_id']); ?>" class="report">Delete question</a>
			<?php } else { ?>
				<a href="<?php URL::to('/question/report?id=' . $question['question_id']); ?>">Report question</a>
			<?php } ?>
		</aside>
		<div class="clear-float"></div>
	</article>
	<?php if(Auth::check()){ ?>
		<div class="form">
			<form action="<?php URL::to('/answer'); ?>" method="POST">
				<input type="hidden" value="<?php echo $question['question_id']; ?>" name="question_id">
				<h4>Post an answer</h4>
				<div class="form-group">
					<textarea name="content" id="" cols="30" rows="5" style="width:100%" placeholder="Enter your answer here..."></textarea>
					<div class="clear-float"></div>
				</div>
				<div class="form-group">
					<button type="submit">Post answer</button>
					<div class="clear-float"></div>
				</div>
			</form>
		</div>
	<?php } else { ?>
		<h4><a href="<?php URL::to('/login'); ?>">Login</a> to post an answer</h4>
	<?php } ?>
	<h5><?php if(count($question['answers']) != 1) {echo count($question['answers']) . " Answers";} else {echo "1 Answer";} ?></h5>

	<?php foreach($question['answers'] as $answer){ ?>
		<article class="content answer">
			<aside class="left-side">
				<div class="avatar">
					<img src="/public/img/avatar2.jpg" alt="">
				</div>
				<a href="" class="profile-name"><?php echo $answer['first_name'] . " " . $answer['last_name']; ?></a>
				<div class="vote">
					<img src="public/img/up-arrow.png" alt="" class="arrow">
					<p><?php echo $answer['votes']; ?></p>
					<img src="public/img/down-arrow.png" alt="" class="arrow">
				</div>
			</aside>
			<aside class="right-side">
				<div class="description">
					<?php echo $answer['content']; ?>
				</div>
				<p class="posted">posted on <?php echo date("M d \a\\t H:i", strtotime($answer['created_at'])); ?></p>
				<?php if($_SESSION['user_id'] == $answer['user_id']) { ?>
					<a href="<?php URL::to('/answer/delete?id=' . $answer['answer_id']); ?>" class="report">Delete answer</a>
				<?php } else { ?>
					<a href="<?php URL::to('/answer/report?id=' . $answer['answer_id']); ?>">Report answer</a>
				<?php } ?>
			</aside>
			<div class="clear-float"></div>
		</article>
	<?php } ?>
</section>