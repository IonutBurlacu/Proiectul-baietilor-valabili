<?php
    class UserController {

        protected $layout = "user/layout/master";

        public function indexLogin(){
        	$id = 1;
        	return View::makeWithLayout('user/home/index', $this->layout, array("id" => $id));
        }

        public function login(){
        	$allInput = Input::all("POST");
        	$username = $allInput['username'];
        	$result = DB::query("SELECT * FROM user WHERE username = '$username'");
        	var_dump($result);
        }
        
    }
 ?>
