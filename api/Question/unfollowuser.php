<?php
include "../Account/db.php";

//$uID = $_SESSION['user_ID'];
$fID=$_POST['follow_ID'];

$r=mysqli_query($con,"DELETE FROM follow_user WHERE follow_id='$fID'");

if($r){
    echo json_encode("The user has been unfollowed");
    die();
}else{
    echo json_encode("query failed");
}

 ?>