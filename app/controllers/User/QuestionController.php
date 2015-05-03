<?php 

class QuestionController {

	protected $layout = 'user/layout/master';

	public function show(){
		return View::makeWithLayout('user/question/details', $this->layout);
	}


}

 ?>