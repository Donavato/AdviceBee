<?php
include "db.php";
include "../phpmailer/PHPMailerAutoload.php";

if(isset($_POST['reg']))
{
   //STORE VALUES FROM THE FORM INTO VARIABLES
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $email=$_POST['email'];
   $email=strtolower($email);
   $password=$_POST['password'];

   //HASH PASSWORD
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   //CREATE RANDOM HASH FOR EMAIL VERIFICATION
   $hash = md5(rand(0,1000));

   //CHECK IF EMAIL ALREADY EXISTS
   $check=mysqli_query($con, "SELECT * FROM `users` WHERE email='$email'");
   $match = mysqli_num_rows($check);

   //IF EMAIL EXIST SEND MESSAGE 'EMAIL EXIST' ELSE PROCEED WITH REGISTRATION
   if($match > 0){
      echo json_encode("email exist");
      die();

   }else{

      try {
         $query=mysqli_query($con,"INSERT INTO `users` (`f_name`,`l_name`,`email`,`passwrd`,`ehash`) VALUES ('$fname','$lname','$email','$hashed_password','$hash')");
         
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
         $mail->Subject = 'AdviceBee | Email Verification';
         $mail->Body    = '
         Thanks for signing up!<br>
         Your account has been created, you can create a question after verifying your email by pressing the url below.<br><br>
         
         Please click this link to activate your email:<br>
         http://13.59.122.228/api/Account/emailverify.php?email='.$email.'&hash='.$hash.'<br>
         
         ';
     
         $mail->send();
         echo json_encode("success");

     } catch (Exception $e) {
         echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
     }
      
   }

}

 ?>