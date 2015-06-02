<?php 

class Mail {

	public static function send($email, $message){
		require App::path('base') . "/vendor/classes/PHPMailer-master/PHPMailerAutoload.php";
		$mail = new PHPMailer(true);

		$mail->IsSMTP(); 
	    $mail->SMTPAuth = true;
	    $mail->SMTPSecure = "ssl";
	    $mail->Host = "smtp.gmail.com";
	    $mail->Port = 465;
	    $mail->Username = "burlacuionutmihai@gmail.com";
	    $mail->Password = "IoNuTMiHaI259";

	    $mail->AddAddress($email);
		$mail->SetFrom("no-reply@adwise.com", "Adwise");
		$mail->Subject = "Reset password";
		$mail->Body = $message;

		$mail->Send();
	}

}

 ?>