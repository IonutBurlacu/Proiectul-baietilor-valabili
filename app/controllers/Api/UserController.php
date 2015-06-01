<?php
    class UserController {

        public function usersList(){
            $users = DB::query("SELECT id,avatar,first_name,last_name FROM user");

            header('Content-Type: application/json');
            echo json_encode(array("users" => $users));
            return;
        }

        public function profile(){
            $id = Input::get('id');
            $user = DB::query("SELECT id,first_name,last_name,email,gender,avatar,phone FROM user WHERE id = '$id'")[0];
            $user['badges'] = DB::query("SELECT badge.title, badge.description FROM user_badge LEFT JOIN badge ON badge.id = user_badge.badge_id WHERE user_badge.user_id = '$id'");
            $user['interests'] = DB::query("SELECT interest.title FROM user_interest LEFT JOIN interest ON interest.id = user_interest.interest_id WHERE user_interest.user_id = '$id'");
            $user['question_count'] = DB::query("SELECT COUNT(*) as count FROM question WHERE user_id = '$id'")[0]['count'];
            $user['answer_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '$id'")[0]['count'];

            header('Content-Type: application/json');
            echo json_encode(array($user));
            return;   
        }

        public function register(){
            $allInput = Input::all("POST");
            $result = Auth::register($allInput);
            if($result['success']){
                Auth::login($allInput);
                header('Content-Type: application/json');
                echo json_encode(array("success" => 1, "message" => "Register success."));
                return;
            }
            else {
                header('Content-Type: application/json');
                echo json_encode(array("success" => 0, "message" => $result['message']));
                return;
            }
        }

        public function login(){
            $allInput = Input::all("POST");
            $result = Auth::login($allInput);
            if($result['success']){
                $user_id = DB::query("SELECT id FROM user WHERE email = '".$allInput['email']."'")[0]['id'];
                header('Content-Type: application/json');
                echo json_encode(array("success" => 1, "message" => "Login success.", "user_id" => $user_id));
                return;
            }
            else {
                header('Content-Type: application/json');
                echo json_encode(array("success" => 0, "message" => $result['message']));
                return;
            }
        }

        public function indexRegister(){
            return View::makeWithLayout('user/login/register', $this->layout);
        }

        
        public function logout(){
            Auth::logout();
            return Redirect::to('/');
        }

        public function profileIndex(){
            $id = Input::get('id');
            $user = DB::query("SELECT id,first_name,last_name,email,gender,avatar,phone FROM user WHERE id = '$id'")[0];
            $user['badges'] = DB::query("SELECT badge.title, badge.description FROM user_badge LEFT JOIN badge ON badge.id = user_badge.badge_id WHERE user_badge.user_id = '$id'");
            $user['interests'] = DB::query("SELECT interest.title FROM user_interest LEFT JOIN interest ON interest.id = user_interest.interest_id WHERE user_interest.user_id = '$id'");
            $user['question_count'] = DB::query("SELECT COUNT(*) as count FROM question WHERE user_id = '$id'")[0]['count'];
            $user['answer_count'] = DB::query("SELECT COUNT(*) as count FROM answer WHERE user_id = '$id'")[0]['count'];

            return View::makeWithLayout('/user/profile/index', $this->layout, array('user' => $user));
        }

        public function saveAvatar(){
            $file = $_FILES['avatar'];
            $target_dir = "public/img/avatar/";
            $file_name = $this->generateRandomString(30) . "." . pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);;
            $target_file = $target_dir . $file_name;
        
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

            $user_id = Input::post('user_id');
            DB::query("UPDATE user SET avatar = '$file_name' WHERE id = '$user_id'", "update");

            echo $file_name;
            return;
        }

        public function editProfileIndex(){
            $id = Input::get('id');
            if($id != Auth::getUserId()){
                return Redirect::to('/');
            }
            else {
                $user = DB::query("SELECT id,first_name,last_name,email,avatar,phone FROM user WHERE id = '$id'")[0];
                $user['interests'] = array();
                $interestsIds = DB::query("SELECT interest.id FROM user_interest LEFT JOIN interest ON interest.id = user_interest.interest_id WHERE user_interest.user_id = '$id'");
                foreach($interestsIds as $id){
                    $user['interests'][] = $id['id'];
                }
                $interests = DB::query("SELECT * FROM interest");

                return View::makeWithLayout('/user/profile/edit', $this->layout, array('input' => $user, 'interests' => $interests));
            }
        }

        public function editProfile(){
            $input = Input::all('POST');
            var_dump($input);
            // return;
            if($input['first_name'] != "" && $input['last_name'] != "" && $input['phone'] != ""){
                $user_id = Auth::getUserId();
                DB::query("UPDATE `user` SET `first_name` = '".$input['first_name']."', `last_name` = '".$input['last_name']."', `phone` = '".$input['phone']."' WHERE id = '$user_id'", "update");

                DB::query("DELETE FROM user_interest WHERE user_id = '$user_id'", "delete");

                foreach($input['interests'] as $id){
                    DB::query("INSERT INTO user_interest VALUES('$user_id', '$id')", "insert");
                }

                return Redirect::to('/profile?id=' . $user_id);
            }
            else {
                $interests = DB::query("SELECT * FROM interest");
                return View::makeWithLayout('/user/profile/edit', $this->layout, array('message' => 'All fields are required.', 'input' => $input, 'interests' => $interests));
            }
        }

        public function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        

    }
 ?>
