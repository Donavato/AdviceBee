<?php    
include "db.php";

function logout()
{
    $_SESSION = array(); //destroy all of the session variables
    session_destroy();
    echo json_encode("session has been closed");
    die();
}
$points=$_SESSION['points'];
$today = date("Y-m-d");
$uID=$_SESSION['user_ID'];
mysqli_query($con,"UPDATE `points` SET `points`='$points' WHERE `user_id`='$uID' AND `date`='$today'");
logout();
?>