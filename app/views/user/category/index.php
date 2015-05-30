<section class="home-listing">
	<h4>Questions about <?php echo $category; ?></h4>
	<?php if(count($questions) == 0) { ?>
		<div class="form">
			<h4>No questions available.</h4>
		</div>
	<?php } else { ?>
		<ul class="questions">
			<?php foreach($questions as $question) { ?>
				<li>
					<div class="left-side">
						<p><?php echo $question['votes_count']; ?> votes</p>
						<p><?php echo $question['answers_count']; ?> answers</p>
					</div>
					<div class="right-side">
						<a href="<?php URL::to('/question?id=' . $question['question_id']); ?>"><?php echo $question['title']; ?></a>
						<?php if(count($question['tags']) > 0){ ?>
							<ul class="tags">
								<?php foreach($question['tags'] as $tag){ ?>
									<li>
										<?php echo $tag['content']; ?>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
						<div class="asked-by">
							<span>asked by </span><a href="<?php URL::to('/profile?id=' . $question['user_id']); ?>"><?php echo $question['first_name'] . " " . $question['last_name']; ?></a>
						</div>
					</div>
					<div class="clear-float"></div>
				</li>
			<?php } ?>
		</ul>
	<?php } ?>
</section>
