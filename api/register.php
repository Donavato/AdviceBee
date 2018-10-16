<?php
 include "db.php";

 if(isset($_POST['reg']))
 {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query=mysqli_query($con,"INSERT INTO `users` (`f_name`,`l_name`,`email`,`passwrd`) VALUES ('$fname','$lname','$email','$password')");
    
    if($query)
    echo "success";
    else
    echo "error";
 }

 ?>