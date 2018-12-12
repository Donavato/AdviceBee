<?php
include "db.php";
include "../phpmailer/PHPMailerAutoload.php";

 if(isset($_POST['pwreset']))
 {

   $email=$_POST['email'];

   //HASH FOR PASSWORD RESET, TAKE FIRST 6 CHARACTERS FROM RANDOM MD5 HASH
   $hash = substr(md5(rand(0,1000)), 0, 6);

   //RE-HASH RANDOM MD5 FOR DATABASE
   $h_passwrd = password_hash($hash, PASSWORD_DEFAULT);

   //FIND USER ACCOUNT WITH PROVIDED EMAIL
   $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
   $match = mysqli_num_rows($query);

   //IF FOUND UPDATE users TABLE WITH NEW HASHED PASSWORD
   if($match > 0){
   
   try {
      mysqli_query($con, "UPDATE users SET passwrd='$h_passwrd' WHERE email='$email'") or die(mysql_error());

      //Server settings
      $mail = new PHPMailer();
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'advicebee123@gmail.com';                 // SMTP username
      $mail->Password = 'Advicebee1';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to
  
      //Recipients
      $mail->setFrom('no-reply@advicebee.com', 'AdviceBee');
      $mail->addAddress($email);     // Add a recipient
  
  
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Account Password Reset';
      $mail->Body    = "
      Hello, you recently requested to reset your password!<br>
      Your account password has been reset, you can login with your new password now.<br><br>
      
      Password: $hash <br>
   
      ";
  
      $mail->send();
      echo json_encode("valid");

  } catch (Exception $e) {

      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

  }

   }else{
      echo json_encode("not valid");
      die();
   }


 }

 ?>