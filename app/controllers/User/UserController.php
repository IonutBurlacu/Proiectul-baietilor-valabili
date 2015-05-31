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

        public function profileIndex(){
            $id = Input::get('id');
            $user = DB::query("SELECT id,first_name,last_name,email,avatar FROM user WHERE id = '$id'")[0];
            $user['badges'] = DB::query("SELECT badge.id, badge.title FROM user_badge LEFT JOIN badge ON badge.id = user_badge.badge_id WHERE user_badge.user_id = '$id'");
            $user['interests'] = DB::query("SELECT interest.id, interest.title FROM user_interest LEFT JOIN interest ON interest.id = user_interest.interest_id WHERE user_interest.user_id = '$id'");
            $user['question_count'] = DB::query("SELECT COUNT(*) as count FROM question WHERE user_id = '$id'")[0]['count'];
            $user['answer_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '$id'")[0]['count'];
            // var_dump($user);
            return View::makeWithLayout('/user/profile/index', $this->layout, array('user' => $user));
        }

    }
 ?>
