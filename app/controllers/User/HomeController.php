<?php
    class HomeController {

    	protected $layout = "user/layout/master";

        public function index(){
        	return View::makeWithLayout('user/home/index', $this->layout);
        }

        
    }
 ?>
