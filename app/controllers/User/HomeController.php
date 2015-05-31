<?php
    class HomeController {

    	protected $layout;

        public function __construct(){
            $this->layout = array('header' => "user/layout/header", 'footer' => "user/layout/footer");
            $this->layout["vars"] = array();
            $this->layout["vars"]["categories"] = DB::query("SELECT id, title FROM category");
        }

        public function latest(){
        	$latestQuestions = DB::query("SELECT question.id as question_id, question.content, question.title, user.id as user_id, user.first_name, user.last_name FROM question INNER JOIN user ON question.user_id = user.id ORDER BY question.created_at DESC LIMIT 20");
        	foreach($latestQuestions as &$question){
        		$question_id = $question['question_id'];
        		$question['tags'] = DB::query("SELECT id, content FROM tag WHERE question_id = '".$question["question_id"]. "'");
                $upvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 2")[0]['count'];
                $downvotes = DB::query("SELECT COUNT(*) as count FROM vote_question WHERE question_id = '".$question["question_id"]. "' AND type = 1")[0]['count'];
                $question['votes_count'] = $upvotes - $downvotes;
        		$question['answers_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE question_id = '".$question["question_id"]. "'")[0]["count"];
        		$question['user_answers'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '".$question["user_id"]. "'")[0]["count"];
        	}
        	return View::makeWithLayout('user/home/index', $this->layout, array("latestQuestions" => $latestQuestions));
        }

        
    }
 ?>
