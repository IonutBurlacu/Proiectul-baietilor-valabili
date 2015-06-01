<?php 

class QuestionController {

	protected $layout;

    public function __construct(){
        $this->layout = array('header' => "user/layout/header", 'footer' => "user/layout/footer");
        $this->layout["vars"] = array();
        $this->layout["vars"]["categories"] = DB::query("SELECT id, title FROM category");
    }

    public function seed(){
    	for($i = 1; $i <= 20; $i++){
    		$user = array(
    			"email" => "email" . $i . "@email.com",
    			"password" => md5("123456"),
    			"first_name" => "First" . $i,
    			"last_name" => "Last" . $i,
    			"gender" => rand(1,2) 
    		);
    		if($user['gender'] == 1){
    			$user['avatar'] = "male.png";
    		}
    		else {
    			$user['avatar'] = "female.png";
    		}

    		$columns = implode(", ",array_keys($user));
			$escaped_values = array_map(create_function('$a', 'return "\'$a\'";'), array_values($user));
			$values  = implode(", ", $escaped_values);
			
			DB::query("INSERT INTO `user`($columns) VALUES ($values)", "insert");
    	}

    	$titles = array("If you could go back in time and change one thing, what would that be?",
    		"How long does it take for you to get ready in the morning?",
    		"What are things that you should not say at your own wedding?",
    		"What do you think your life will look like in 10 years?",
    		"If you knew that you only had a year left to live, what would you do?",
    		"What is your first memory?",
    		"What is the last thing you do before you go to sleep?",
    		"Tell me about your dream house.",
    		"What do you think your life will look like in 10 years?",
    		"If you were given three wishes, what would you wish for?",
    		"What was the last gift that you received?",
    		"If you could be any celebrity, who would it be?",
    		"What are your favorite TV shows?",
    		"What qualities do you value most in a friend?",
    		"What’s one of your worst habits?",
    		"Do you prefer to shop online or in a store?",
    		"What is the least favorite thing about this week?",
    		"What is the last thing you do before you go to sleep?",
    		"What is your first memory?",
    		"Do you have any siblings?");

    	for($i = 1; $i <= 500; $i++){
    		$question = array(
    			"user_id" => rand(1,20),
    			"category_id" => rand(1,13),
    			"title" => $titles[rand(0,19)],
    			"content" => "Donec facilisis sodales libero, ut mattis quam sollicitudin quis. Cras finibus enim quis dignissim placerat. Quisque vitae interdum risus, fringilla porta augue. Praesent ullamcorper non sapien vitae scelerisque. Nam blandit fringilla risus eu eleifend. In libero ex, sollicitudin aliquam blandit nec, facilisis non lorem. Fusce aliquam in tellus id finibus. Pellentesque vitae leo sit amet libero tincidunt rutrum.",
    			"created_at" => date("Y-m-d H:i:s")
    		);

    		$columns = implode(", ",array_keys($question));
			$escaped_values = array_map(create_function('$a', 'return "\'$a\'";'), array_values($question));
			$values  = implode(", ", $escaped_values);
			$sql = DB::query("INSERT INTO `question`($columns) VALUES ($values)", "insert");
    	}

    	for($i = 1; $i < 5000; $i++){
    		$answer = array(
    			"user_id" => rand(1,20),
    			"question_id" => rand(1,500),
    			"content" => "Nam consequat congue tellus, eu congue ex lacinia in. Vivamus viverra pharetra eros, vitae auctor est feugiat in. Duis id urna consectetur, fermentum est vel, placerat lacus. Sed mi quam, elementum sed nunc a, dignissim suscipit risus.",
    			"created_at" => date("Y-m-d H:i:s")
    		);

    		$columns = implode(", ",array_keys($answer));
			$escaped_values = array_map(create_function('$a', 'return "\'$a\'";'), array_values($answer));
			$values  = implode(", ", $escaped_values);
			$sql = DB::query("INSERT INTO `answer`($columns) VALUES ($values)", "insert");
    	}

    	for($i = 1; $i <= 1500; $i++){
    		DB::query("INSERT INTO `tag`(content,question_id) VALUES ('"."tag" . rand(10,50) . "','".rand(1,500)."')", "insert");
    	}
    }

	public function show(){
		$id = Input::get('id');
		$question = DB::query("SELECT question.id as question_id, question.title, question.content, question.created_at, user.id as user_id, user.first_name, user.last_name, user.avatar FROM question INNER JOIN user ON user.id = question.user_id WHERE question.id = '$id'")[0];
		if($question == NULL){
			return Redirect::to('/');
		}
		else {
			$upvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '$id' AND type = 2")[0]['count'];
			$downvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '$id' AND type = 1")[0]['count'];
			$question['votes'] = $upvotes - $downvotes;
			$user_id = Auth::getUserId();
			$voted = DB::query("SELECT type FROM vote_question WHERE question_id = '$id' AND user_id = '$user_id'");
			if(count($voted) == 1){
				$question['voted'] = $voted[0]['type'];
			}
			else {
				$question['voted'] = 0;
			}
			$reported = DB::query("SELECT COUNT(*) AS count FROM report_question WHERE user_id = '".Auth::getUserId()."' AND question_id = '$id'")[0]['count'];
			$question['reported'] = $reported;
			$question['answers'] = DB::query("SELECT answer.id as answer_id, answer.content, answer.created_at, user.id AS user_id, user.first_name, user.last_name, user.avatar FROM answer INNER JOIN user ON user.id = answer.user_id WHERE answer.question_id = '$id' ORDER BY answer.created_at DESC");
			foreach($question['answers'] as &$answer){
				$upvotes = DB::query("SELECT COUNT(*) as count FROM vote_answer WHERE answer_id = '". $answer['answer_id'] . "' AND type = 2")[0]['count'];
				$downvotes = DB::query("SELECT COUNT(*) as count FROM vote_answer WHERE answer_id = '". $answer['answer_id'] . "' AND type = 1")[0]['count'];
				$answer['votes'] = $upvotes - $downvotes;
				$voted = DB::query("SELECT type FROM vote_answer WHERE answer_id = '". $answer['answer_id'] ."' AND user_id = '$user_id'");
				if(count($voted) == 1){
					$answer['voted'] = $voted[0]['type'];
				}
				else {
					$answer['voted'] = 0;
				}
				$reported = DB::query("SELECT COUNT(*) AS count FROM report_answer WHERE user_id = '".Auth::getUserId()."' AND answer_id = '".$answer['answer_id']."'")[0]['count'];
				$answer['reported'] = $reported;
			}

			return View::makeWithLayout('user/question/details', $this->layout, array('question' => $question));
		}
	}

	public function categoryIndex(){
		$id = Input::get('id');
		$page = (Input::get('page') != null) ? Input::get('page') : 1;
		$questions = DB::query("SELECT question.id as question_id, question.title, question.created_at, user.id as user_id, user.first_name, user.last_name FROM question INNER JOIN user ON question.user_id = user.id WHERE question.category_id = '$id' LIMIT 10 OFFSET ".($page-1)*10);
		$questionsCount = DB::query("SELECT COUNT(*) AS count FROM question WHERE category_id = '$id'")[0]['count'];
		foreach($questions as &$question){
			$question['tags'] = DB::query("SELECT id, content FROM tag WHERE question_id = '".$question["question_id"]. "'");
			$upvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 2")[0]['count'];
			$downvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 1")[0]['count'];
			$question['votes_count'] = $upvotes - $downvotes;
    		$question['answers_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE question_id = '".$question["question_id"]. "'")[0]["count"];
    		$question['user_answers'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '".$question["user_id"]. "'")[0]["count"];
		}
		$category = DB::query("SELECT category.id, category.title FROM category WHERE id = '$id'")[0];
		return View::makeWithLayout('user/category/index', $this->layout, array('questions' => $questions, 'category' => $category, 'page' => $page, 'count' => $questionsCount));
	}

	public function indexAsk(){
		return View::makeWithLayout('user/question/ask', $this->layout);	
	}

	public function ask(){
		$user_id = Auth::getUserId();
		$category_id = Input::post('category');
		$title = Input::post('title');
		$content = Input::post('content');
		$created_at = date('Y-m-d H:i:s');

		/* save question */
		DB::query("INSERT INTO question(`user_id`,`category_id`,`title`,`content`,`created_at`) VALUES ('$user_id','$category_id','$title','$content','$created_at')", "insert");

		/* save tags */
		$question_id = DB::dbInstance()->lastInsertId();
		$tags = explode(',', Input::post('tags'));
		foreach($tags as $tag){
			DB::query("INSERT INTO tag(`question_id`,`content`) VALUES('$question_id','$tag')", "insert");
		}

		/* Altruist/Curious */

		$questionsCount = DB::query("SELECT COUNT(*) AS count FROM question WHERE user_id = '$user_id'")[0]['count'];
		if($questionsCount == 1){
			//altruist
			DB::query("DELETE FROM user_badge WHERE user_id = '$user_id' AND badge_id = 1", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$user_id', 1)", "insert");
		}
		else if($questionsCount == 10){
			//curious
			DB::query("DELETE FROM user_badge WHERE user_id = '$user_id' AND badge_id = 2", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$user_id', 2)", "insert");
		}

		return Redirect::to('/category?id=' . $category_id);
	}

	public function deleteQuestion(){
		$id = Input::get('id');
		DB::query("DELETE FROM question WHERE id = '$id'", "delete");

		return Redirect::to('/');
	}

	public function answer(){
		$user_id = Auth::getUserId();
		$question_id = Input::post('question_id');
		$content = Input::post('content');
		$created_at = date('Y-m-d H:i:s');

		/* save answer */
		DB::query("INSERT INTO answer(`user_id`,`question_id`,`content`,`created_at`) VALUES ('$user_id','$question_id','$content','$created_at')", "insert");

		return Redirect::to('/question?id=' . $question_id);
	}

	public function deleteAnswer(){
		$id = Input::get('id');
		$question_id = DB::query("SELECT question_id FROM answer WHERE id = '$id'")[0]['question_id'];

		DB::query("DELETE FROM answer WHERE id = '$id'", "delete");

		return Redirect::to('/question?id=' . $question_id);	
	}

	public function voteQuestion(){
		$user_id = Input::post('user_id');
		$question_id = Input::post('question_id');
		$type = Input::post('type');
		$voted = Input::post('voted');

		DB::query("DELETE FROM vote_question WHERE user_id = '$user_id' AND question_id = '$question_id'", "delete");
		if($voted == NULL){
			DB::query("INSERT INTO vote_question VALUES ('$user_id','$question_id','$type')", "insert");
		}

		/* Supporter/Critic */
		
		if($type == 1){
			$votesCount = DB::query("SELECT COUNT(*) AS count FROM vote_question WHERE user_id = '$user_id' AND type = 1")[0]['count'];
			if($votesCount == 1){
				//critic
				DB::query("DELETE FROM user_badge WHERE user_id = '$user_id' AND badge_id = 4", "delete");
				DB::query("INSERT INTO user_badge VALUES ('$user_id', 4)", "insert");
			}
		}
		else {
			$votesCount = DB::query("SELECT COUNT(*) AS count FROM vote_question WHERE user_id = '$user_id' AND type = 2")[0]['count'];
			if($votesCount == 1){
				//supporter
				DB::query("DELETE FROM user_badge WHERE user_id = '$user_id' AND badge_id = 3", "delete");
				DB::query("INSERT INTO user_badge VALUES ('$user_id', 3)", "insert");
			}
		}
		

		/* Nice question/Good question/Student */
		$upVotesCount = DB::query("SELECT COUNT(*) AS count FROM vote_question WHERE question_id = '$question_id' AND type = 2")[0]['count'];
		$otherUserId = DB::query("SELECT user_id FROM question WHERE id = '$question_id'")[0]['user_id'];
		// var_dump($upVotesCount);
		// return;
		if($upVotesCount == 1){
			//student
			DB::query("DELETE FROM user_badge WHERE user_id = '$otherUserId' AND badge_id = 9", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$otherUserId', 9)", "insert");
		}
		else if($upVotesCount == 5){
			//nice question
			DB::query("DELETE FROM user_badge WHERE user_id = '$otherUserId' AND badge_id = 5", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$otherUserId', 5)", "insert");
		}
		else if($upVotesCount == 15){
			//good question
			DB::query("DELETE FROM user_badge WHERE user_id = '$otherUserId' AND badge_id = 6", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$otherUserId', 6)", "insert");
		}

	}

	public function voteAnswer(){
		$user_id = Input::post('user_id');
		$answer_id = Input::post('answer_id');
		$type = Input::post('type');
		$voted = Input::post('voted');

		DB::query("DELETE FROM vote_answer WHERE user_id = '$user_id' AND answer_id = '$answer_id'", "delete");
		if($voted == NULL){
			DB::query("INSERT INTO vote_answer VALUES ('$user_id','$answer_id','$type')", "insert");
		}

		/* Nice answer/Good answer/Teacher */
		$upVotesCount = DB::query("SELECT COUNT(*) AS count FROM vote_answer WHERE answer_id = '$answer_id' AND type = 2")[0]['count'];
		$otherUserId = DB::query("SELECT user_id FROM answer WHERE id = '$answer_id'")[0]['user_id'];
		if($upVotesCount == 1){
			//teacher
			DB::query("DELETE FROM user_badge WHERE user_id = '$otherUserId' AND badge_id = 10", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$otherUserId', 10)", "insert");
		}
		else if($upVotesCount == 5){
			//nice answer
			DB::query("DELETE FROM user_badge WHERE user_id = '$otherUserId' AND badge_id = 7", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$otherUserId', 7)", "insert");
		}
		else if($upVotesCount == 15){
			//good answer
			DB::query("DELETE FROM user_badge WHERE user_id = '$otherUserId' AND badge_id = 8", "delete");
			DB::query("INSERT INTO user_badge VALUES ('$otherUserId', 8)", "insert");
		}
	}

	public function search(){
		$query = Input::get('query');
		$tags = DB::query("SELECT question_id FROM tag WHERE content = '$query'");
		$page = (Input::get('page') != null) ? Input::get('page') : 1;
		$ids = array();

		foreach($tags as $tag){
			$ids[] = $tag['question_id'];
		}
		if(count($ids) > 0){
			$ids = join(',',$ids);

			$questions = DB::query("SELECT question.id as question_id, question.content, question.title, user.id as user_id, user.first_name, user.last_name FROM question INNER JOIN user ON user.id = question.user_id  WHERE question.id IN ($ids) LIMIT 10 OFFSET ".($page-1)*10);
			$questionsCount = DB::query("SELECT COUNT(*) AS count FROM question WHERE question.id IN ($ids)")[0]['count'];
			foreach($questions as &$question){
	        		$question_id = $question['question_id'];
	        		$question['tags'] = DB::query("SELECT id, content FROM tag WHERE question_id = '".$question["question_id"]. "'");
	                $upvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 2")[0]['count'];
	                $downvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 1")[0]['count'];
	                $question['votes_count'] = $upvotes - $downvotes;
	        		$question['answers_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE question_id = '".$question["question_id"]. "'")[0]["count"];
	        		$question['user_answers'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '".$question["user_id"]. "'")[0]["count"];
	        	}
		}
		else {
			$questions = array();
		}
    	return View::makeWithLayout('user/search/index', $this->layout, array("questions" => $questions, 'query' => $query, 'page' => $page, 'count' => $questionsCount));
	}

	public function reportQuestion(){
		$user_id = Input::get('user_id');
		$question_id = Input::get('question_id');

		DB::query("INSERT INTO report_question VALUES('$user_id','$question_id')", "insert");

		$reportsCount = DB::query("SELECT COUNT(*) AS count FROM report_question WHERE question_id = '$question_id'")[0]['count'];
		if($reportsCount == 5){
			DB::query("DELETE FROM question WHERE id = '$question_id'");
			return Redirect::to('/');
		}
		else {
			return Redirect::to('/question?id=' . $question_id);
		}
	}

	public function reportAnswer(){
		$user_id = Input::get('user_id');
		$answer_id = Input::get('answer_id');
		$question_id = Input::get('question_id');

		DB::query("INSERT INTO report_answer VALUES('$user_id','$answer_id')", "insert");

		$reportsCount = DB::query("SELECT COUNT(*) AS count FROM report_answer WHERE answer_id = '$answer_id'")[0]['count'];
		if($reportsCount == 5){
			DB::query("DELETE FROM answer WHERE id = '$answer_id'");
		}
		return Redirect::to('/question?id=' . $question_id);
	}

}

 ?>