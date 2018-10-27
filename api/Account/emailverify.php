<?php
include "db.php";

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

    $email=$_GET['email'];
    $emailhash=$_GET['hash'];
                 
    $search = mysqli_query($con, "SELECT * FROM `users` WHERE email='".$email."' AND ehash='".$emailhash."' AND active='0'") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);

    if($match > 0){
        mysqli_query($con, "UPDATE `users` SET active='1' WHERE email='".$email."' AND ehash='".$emailhash."' AND active='0'") or die(mysql_error());
        echo 'Your email has been activated, you can now create a question!';
    }else{
        echo 'The url is either invalid or you already have activated your email.';
    }
                 
}else{
    echo 'Invalid approach, please use the link that has been send to your email.';
}

?>