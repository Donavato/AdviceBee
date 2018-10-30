<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$qID=$_POST['Question_ID'];

$query=mysqli_query($con,"SELECT * FROM `list_posts` WHERE user_ID='$uID' AND question_ID='$qID'");
$match  = mysqli_num_rows($query);
echo $match;
// //die();

// if($match == true){
//     mysqli_query($con,"INSERT INTO `like_posts` (`user_ID`,`question_ID`) VALUES ('$uID','$qID')");
//     echo json_encode("Question Liked!");
//     die();

// }else{
//     echo json_encode("Question has already been Liked!");
//     die();
// }

 ?>