<?php 

class QuestionController {

	public function details(){
		$id = Input::get('id');
		$question = DB::query("SELECT question.id as question_id, question.title, question.content, question.created_at, user.id as user_id, user.first_name, user.last_name FROM question INNER JOIN user ON user.id = question.user_id WHERE question.id = '$id'")[0];

		if($question != null){
			$upvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '$id' AND type = 2")[0]['count'];
			$downvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '$id' AND type = 1")[0]['count'];
			$question['votes'] = $upvotes - $downvotes;
			
			$question['answers'] = DB::query("SELECT answer.id as answer_id, answer.content, answer.created_at, user.id AS user_id, user.first_name, user.last_name FROM answer INNER JOIN user ON user.id = answer.user_id ORDER BY answer.created_at DESC");
			foreach($question['answers'] as &$answer){
				$upvotes = DB::query("SELECT COUNT(*) as count FROM vote_answer WHERE answer_id = '". $answer['answer_id'] . "' AND type = 2")[0]['count'];
				$downvotes = DB::query("SELECT COUNT(*) as count FROM vote_answer WHERE answer_id = '". $answer['answer_id'] . "' AND type = 1")[0]['count'];
				$answer['votes'] = $upvotes - $downvotes;
				
			}
		}
		else {
			$question = array();
		}

		header('Content-Type: application/json');
		echo json_encode($question);
		return;
	}

	public function category(){
		$id = Input::get('id');
		$questions = DB::query("SELECT question.id as question_id, question.title, question.created_at, user.id as user_id, user.first_name, user.last_name FROM question INNER JOIN user ON question.user_id = user.id WHERE question.category_id = '$id'");
		foreach($questions as &$question){
			$question['tags'] = DB::query("SELECT content FROM tag WHERE question_id = '".$question["question_id"]. "'");
			$upvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 2")[0]['count'];
			$downvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 1")[0]['count'];
			$question['votes_count'] = $upvotes - $downvotes;
    		$question['answers_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE question_id = '".$question["question_id"]. "'")[0]["count"];
    		$question['user_answers'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '".$question["user_id"]. "'")[0]["count"];
		}

		header('Content-Type: application/json');
		echo json_encode($questions);
		return;
	}

	public function indexAsk(){
		return View::makeWithLayout('user/question/ask', $this->layout);	
	}

	public function ask(){
		$user_id = $_SESSION['user_id'];
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

		return Redirect::to('/category?id=' . $category_id);
	}

	public function deleteQuestion(){
		$id = Input::get('id');
		DB::query("DELETE FROM question WHERE id = '$id'", "delete");

		return Redirect::to('/');
	}

	public function answer(){
		$user_id = $_SESSION['user_id'];
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
			DB::query("INSERT INTO vote_question VALUES ('$user_id','$question_id','$type')");
		}
	}

	public function voteAnswer(){
		$user_id = Input::post('user_id');
		$answer_id = Input::post('answer_id');
		$type = Input::post('type');
		$voted = Input::post('voted');

		DB::query("DELETE FROM vote_answer WHERE user_id = '$user_id' AND answer_id = '$answer_id'", "delete");
		if($voted == NULL){
			DB::query("INSERT INTO vote_answer VALUES ('$user_id','$answer_id','$type')");
		}
	}

}

 ?>