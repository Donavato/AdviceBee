<?php
include "db.php";

 if(isset($_POST['pwreset']))
 {

    $email=$_POST['email'];

    //hash for pw reset
    $hash = substr(md5(rand(0,1000)), 0, 6);
    //RE-HASH for database
    $h_passwrd = password_hash($hash, PASSWORD_DEFAULT);

    $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");
    $match = mysqli_num_rows($query);

    if($match > 0){
    mysqli_query($con, "UPDATE users SET passwrd='$h_passwrd' WHERE email='$email'") or die(mysql_error());

        //EMAIL VERIFICATION
        $to = $email; // Send email to our user
        $subject = 'Account Password Reset'; // Give the email a subject 
    
        //Our message in the email
        $message = "
        Hello, you recently requested to reset your password!
        Your account password has been reset, you can login with your new password now.
        
        Password: $hash
    
        "; 
    
        // PHP MAIL FUNCTION to Send our email
        $headers = 'From:noreply@AdviceBee.com' . "\r\n"; // Set headers *need headers to send mail
        mail($to, $subject, $message, $headers);

      echo json_encode("valid");
      
    }else{
       echo json_encode("not valid");
       die();
    }


 }

 ?>