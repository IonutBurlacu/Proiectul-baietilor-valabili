<section class="question-details">
	<h4>Ask a question</h4>
	<div class="form">
		<form action="<?php URL::to('/ask') ?>" method="POST">
			<div class="form-group">
				<label class="form-label" for="title">Title</label>
				<input class="form-input" type="text" name="title" placeholder="Title" value="<?php if (isset($input['title'])) echo $input['title']; ?>">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="category">Category</label>
				<select name="category" id="category" placeholder="Category">
					<?php 
						foreach($categories as $category){
					?>
						<option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
					<?php
						}
					?>
				</select>
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="content">Content</label>
				<textarea name="content" id="" cols="30" rows="10" placeholder="Content"><?php if (isset($input['content'])) echo $input['content']; ?></textarea>
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="tags">Tags</label>
				<input class="form-input" type="text" name="tags" placeholder="Tags, separated by commas" value="<?php if (isset($input['tags'])) echo $input['tags']; ?>">
				<div class="clear-float"></div>
			</div>
			<div class="form-group">
				<label class="form-label" for="password">&nbsp;</label>
				<button type="submit">Ask question</button>
			</div>
		</form>
	</div>
</section>

<script>
	document.getElementById("ask-link").className = "active";
</script>