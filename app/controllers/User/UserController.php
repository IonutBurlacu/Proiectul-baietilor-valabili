<?php
    class UserController {

        protected $layout;

        public function __construct(){
            $this->layout = array('header' => "user/layout/header", 'footer' => "user/layout/footer");
            $this->layout["vars"] = array();
            $this->layout["vars"]["categories"] = DB::query("SELECT id, title FROM category");
        }

        public function indexLogin(){
        	return View::makeWithLayout('user/login/login', $this->layout);
        }

        public function login(){
        	$allInput = Input::all("POST");
            $result = Auth::login($allInput);
            if($result['success']){
                return Redirect::to('/');
            }
            else {
                return View::makeWithLayout('/user/login/login', $this->layout, array('message' => $result['message'], 'input' => $allInput));
            }
        }

        public function indexRegister(){
            return View::makeWithLayout('user/login/register', $this->layout);
        }

        public function register(){
            $allInput = Input::all("POST");
            $result = Auth::register($allInput);
            if($result['success']){
                Auth::login($allInput);
                return Redirect::to('/');
            }
            else {
                return View::makeWithLayout('/user/login/register', $this->layout, array('message' => $result['message'], 'input' => $allInput));
            }
        }
        
        public function logout(){
            Auth::logout();
            return Redirect::to('/');
        }

    }
 ?>
