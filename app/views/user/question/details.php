<section class="question-details">
	<h4><?php echo $question['title']; ?></h4>
	<article class="content">
		<aside class="left-side">
			<span class="user-id" id="<?php echo Auth::getUserId(); ?>"></span>
			<div class="avatar">
				<img src="<?php URL::to('/public/img/avatar/' . $question['avatar']); ?>" alt="avatar">
			</div>
			<a href="<?php URL::to('/profile?id=' . $question['user_id']); ?>" class="profile-name"><?php echo $question['first_name'] . " " . $question['last_name']; ?></a>
			<div class="vote">
				<?php if($question['voted'] == NULL){ ?>
					<span class="up-arrow" onclick="voteQuestion(this, <?php echo $question['question_id']; ?>, 2)"></span>
					<p><?php echo $question['votes']; ?></p>
					<span class="down-arrow" onclick="voteQuestion(this, <?php echo $question['question_id']; ?>, 1)"></span>
				<?php } else if($question['voted'] == 1) { ?>
					<span class="up-arrow" onclick="voteQuestion(this, <?php echo $question['question_id']; ?>, 2)"></span>
					<p><?php echo $question['votes']; ?></p>
					<span class="down-arrow voted" onclick="voteQuestion(this, <?php echo $question['question_id']; ?>, 1, 1)"></span>
				<?php } else { ?>
					<span class="up-arrow voted" onclick="voteQuestion(this, <?php echo $question['question_id']; ?>, 2, 1)"></span>
					<p><?php echo $question['votes']; ?></p>
					<span class="down-arrow" onclick="voteQuestion(this, <?php echo $question['question_id']; ?>, 1)"></span>
				<?php } ?>
			</div>
		</aside>
		<aside class="right-side">
			<div class="description">
				<?php echo $question['content']; ?>
			</div>
			<p class="posted">asked on <?php echo date("M d \a\\t H:i", strtotime($question['created_at'])); ?></p>
			<?php if(Auth::getUserId() == $question['user_id']) { ?>
				<a href="<?php URL::to('/question/delete?id=' . $question['question_id']); ?>" class="delete">Delete question</a>
			<?php } else if(Auth::getUserId() != NULL && !$question['reported']) { ?>
				<a href="<?php URL::to('/report-question?question_id=' . $question['question_id'] . '&user_id=' . Auth::getUserId()); ?>" class="report">Report question</a>
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
		<h4 style="border:none;"><a href="<?php URL::to('/login'); ?>">Login</a> to post an answer</h4>
	<?php } ?>
	<h5><?php if(count($question['answers']) != 1) {echo count($question['answers']) . " Answers";} else {echo "1 Answer";} ?></h5>

	<?php foreach($question['answers'] as $answer){ ?>
		<article class="content answer">
			<aside class="left-side">
				<div class="avatar">
					<img src="<?php URL::to('/public/img/avatar/' . $answer['avatar']); ?>" alt="avatar">
				</div>
				<a href="<?php URL::to('/profile?id=' . $answer['user_id']); ?>" class="profile-name"><?php echo $answer['first_name'] . " " . $answer['last_name']; ?></a>
				<div class="vote">
					<?php if($answer['voted'] == NULL){ ?>
						<span class="up-arrow" onclick="voteAnswer(this, <?php echo $answer['answer_id']; ?>, 2)"></span>
						<p><?php echo $answer['votes']; ?></p>
						<span class="down-arrow" onclick="voteAnswer(this, <?php echo $answer['answer_id']; ?>, 1)"></span>
					<?php } else if($answer['voted'] == 1) { ?>
						<span class="up-arrow" onclick="voteAnswer(this, <?php echo $answer['answer_id']; ?>, 2)"></span>
						<p><?php echo $answer['votes']; ?></p>
						<span class="down-arrow voted" onclick="voteAnswer(this, <?php echo $answer['answer_id']; ?>, 1, 1)"></span>
					<?php } else { ?>
						<span class="up-arrow voted" onclick="voteAnswer(this, <?php echo $answer['answer_id']; ?>, 2, 1)"></span>
						<p><?php echo $answer['votes']; ?></p>
						<span class="down-arrow" onclick="voteAnswer(this, <?php echo $answer['answer_id']; ?>, 1)"></span>
					<?php } ?>
				</div>
			</aside>
			<aside class="right-side">
				<div class="description">
					<?php echo $answer['content']; ?>
				</div>
				<p class="posted">posted on <?php echo date("M d \a\\t H:i", strtotime($answer['created_at'])); ?></p>
				<?php if($_SESSION['user_id'] == $answer['user_id']) { ?>
					<a href="<?php URL::to('/answer/delete?id=' . $answer['answer_id']); ?>" class="delete">Delete answer</a>
				<?php } else if(Auth::getUserId() != NULL && !$answer['reported']) { ?>
					<a href="<?php URL::to('/report-answer?question_id=' . $question['question_id'] . '&user_id=' . Auth::getUserId() . '&answer_id=' . $answer['answer_id']); ?>" class="report">Report answer</a>
				<?php } ?>
			</aside>
			<div class="clear-float"></div>
		</article>
	<?php } ?>
</section>