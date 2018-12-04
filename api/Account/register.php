<?php
 include "db.php";

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

      //INSERT INTO TABLE USERS ALL THE DATA GIVEN
      $query=mysqli_query($con,"INSERT INTO `users` (`f_name`,`l_name`,`email`,`passwrd`,`ehash`) VALUES ('$fname','$lname','$email','$hashed_password','$hash')");

      //SEND EMAIL VERIFICATION EMAIL
      $to = $email; // Send email to our user
      $subject = 'AdviceBee | Email Verification'; // Give the email a subject 
   
      // Our message including a link to verify email
      $message = '
      Thanks for signing up!
      Your account has been created, you can create a question after verifying your email by pressing the url below.
      
      Please click this link to activate your email:
      http://localhost/api/Account/emailverify.php?email='.$email.'&hash='.$hash.'
      
      ';
   
      // PHP MAIL FUNCTION to Send our email
      $headers = 'From:noreply@AdviceBee.com' . "\r\n"; // Set headers *need headers to send mail
      mail($to, $subject, $message, $headers);

      echo json_encode("success");
   }

}

 ?>