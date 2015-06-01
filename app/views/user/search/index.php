<section class="home-listing">
	<h4>Search results</h4>
	<?php if(count($questions) == 0) { ?>
		<div class="form">
			<h4>No questions available.</h4>
		</div>
	<?php } else { ?>
		<ul class="questions">
			<?php foreach($questions as $question) { ?>
				<li>
					<div class="left-side">
						<p><?php if($question['votes_count'] == 1 || $question['votes_count'] == -1) {echo $question['votes_count'] . " vote";} else {echo $question['votes_count'] . " votes";} ?></p>
						<p><?php if($question['answers_count'] == 1 || $question['answers_count'] == -1) {echo $question['answers_count'] . " answer";} else {echo $question['answers_count'] . " answers";} ?></p>
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
							<span>asked by </span><a href="#"><?php echo $question['first_name'] . " " . $question['last_name']; ?></a>
						</div>
					</div>
					<div class="clear-float"></div>
				</li>
			<?php } ?>
		</ul>
		<ul class="pagination">
			<?php if($page == 1){ ?>
				<li class="inactive"><span>Previous</span></li>
			<?php } else { ?>
				<li><a href="<?php URL::to('/?page=' . ($page-1) . '&query=' . $query) ?>">Previous</a></li>
				<li><a href="<?php URL::to('/?page=' . ($page-1) . '&query=' . $query) ?>"><?php echo $page-1; ?></a></li>
			<?php } ?>
			<li class="active"><a href="<?php URL::to('/?page=' . ($page) . '&query=' . $query) ?>"><?php echo $page; ?></a></li>
			<?php if($page >= intval($count/10)){ ?>
				<li class="inactive"><span>Next</span></li>
			<?php } else { ?>
				<li><a href="<?php URL::to('/?page=' . ($page+1) . '&query=' . $query) ?>"><?php echo $page+1; ?></a></li>
				<li><a href="<?php URL::to('/?page=' . ($page+1) . '&query=' . $query) ?>">Next</a></li>
			<?php } ?>
		</ul>
	<?php } ?>
</section>
