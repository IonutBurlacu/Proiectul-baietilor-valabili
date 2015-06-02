<?php 

class Auth {

	public static function login(array $credentials){
		$email = $credentials['email'];
		$password = md5($credentials['password']);
		$result = DB::query("SELECT id, password FROM user WHERE email = '$email'");
		if(count($result) > 0){
			if($password == $result[0]['password']){
				$_SESSION['user_id'] = $result[0]['id'];
				return array('success' => 1);
			}
			else {
				return array('success' => 0, 'message' => 'The email and password does not match.');
			}
		}
		else {
			return array('success' => 0, 'message' => 'The email and password does not match.');
		}
	}

	public static function register(array $info){
		$email = $info['email'];
		$password = $info['password'];
		$password2 = $info['password2'];
		$first_name = $info['first_name'];
		$last_name = $info['last_name'];
		$gender = $info['gender'];
		$avatar = ($gender == 1) ? "male.png" : "female.png";

		if($email != "" && $password != "" && $first_name != "" && $last_name != "" && $gender != ""){
			if($password == $password2){
				$result = DB::query("SELECT COUNT(*) as count FROM user WHERE email = '$email'");
				if($result[0]['count'] == 0){
					$password = md5($password);

					DB::query("INSERT INTO user(`email`,`password`,`first_name`,`last_name`,`gender`,`avatar`) VALUES ('$email','$password','$first_name','$last_name','$gender','$avatar')", "insert");
					return array('success' => 1);
				}
				else {
					return array('success' => 0, 'message' => 'Email is already taken.');
				}
			}
			else {
				return array('success' => 0, 'message' => 'Passwords do not match.');
			}
		}
		else {
			return array('success' => 0, 'message' => 'All fields are required.');
		}
	}

	public static function check(){
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
			return 1;
		}
		else {
			return 0;
		}
	}

	public static function getUserId(){
		
		if(isset($_SESSION['user_id'])){
			return $_SESSION['user_id'];
		}
		else {
			return NULL;
		}
	}

	public static function logout(){
		unset($_SESSION['user_id']);
	}

}

 ?>