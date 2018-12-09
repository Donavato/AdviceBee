<?php
include "db.php";

//GRAB STORE DATA FROM HTML ACTIVATION LINK
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

    //STORE DATA INTO VARIABLES
    $email=$_GET['email'];
    $emailhash=$_GET['hash'];
    
    //SEARCH FOR USER EMAIL AND RANDOM GENERATED MD5 IN DATABASE TO VERIFY USER
    $search = mysqli_query($con, "SELECT * FROM `users` WHERE email='".$email."' AND ehash='".$emailhash."' AND active='0'") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);

    //IF EXIST, SET ACTIVE COLUMN TO '1'
    if($match > 0){
        mysqli_query($con, "UPDATE `users` SET active='1' WHERE email='".$email."' AND ehash='".$emailhash."' AND active='0'") or die(mysql_error());
        echo 'Your email has been verified, you can now ask a question!';
    }else{
        echo 'The url is either invalid or you already have activated your account.';
    }
                 
}else{
    echo 'Invalid approach, please use the link that has been send to your email.';
}

?>