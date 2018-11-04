<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$aID=$_POST['advice_ID'];

$query=mysqli_query($con, "SELECT * FROM like_advices WHERE advice_ID='$aID' AND user_ID='$uID'");
$match  = mysqli_num_rows($query);

if($match > 0){
    echo json_encode("You have already liked this advice!");
    die();
}else{
    mysqli_query($con,"INSERT INTO like_advices (`advice_ID`,`user_ID`,`advice_like`) VALUES ('$aID','$uID','1')");
    echo json_encode("Advice Liked!");
    die();
}

 ?>