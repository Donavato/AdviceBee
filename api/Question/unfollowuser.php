<?php
include "../Account/db.php";

$fID=$_POST['follow_ID'];

//DELETE FROM FOLLOW_USER TABLE
$r=mysqli_query($con,"DELETE FROM follow_user WHERE follow_id='$fID'");

//IF QUERY, DISPLAY NOTIFITCATION ELSE QUERY ERROR CHECK
if($r){
    echo json_encode("The user has been unfollowed");
    die();
}else{
    echo json_encode("query failed");
}

 ?>