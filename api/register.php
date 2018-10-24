<?php
 include "db.php";

 if(isset($_POST['reg']))
 {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $email=strtolower($email);
    $password=$_POST['password'];
    //hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query=mysqli_query($con,"INSERT INTO `users` (`f_name`,`l_name`,`email`,`passwrd`) VALUES ('$fname','$lname','$email','$hashed_password')");
    
    if($query)
    echo "success";
    else
    echo "error";
 }

 ?>