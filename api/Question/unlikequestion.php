<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$qID=$_POST['Question_ID'];

$r=mysqli_query($con,"DELETE FROM `like_posts` WHERE question_ID='$qID'");

if($r){
    echo json_encode("Question has been unliked");
    die();
}

 ?>