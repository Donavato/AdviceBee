<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$uID2 = $_POST["uID2"];
//$qID = $_POST["Question_ID"];

$query=mysqli_query($con, "SELECT * FROM follow_user WHERE user_ID1='$uID' AND user_ID2='$uID2'");
$match  = mysqli_num_rows($query);

if($match > 0){
    echo json_encode("You have already followed this user!");
    die();
}else{
    mysqli_query($con,"INSERT INTO follow_user (`user_ID1`,`user_ID2`) VALUES ('$uID','$uID2')");
    echo json_encode("Followed User!");
    die();
}

?>