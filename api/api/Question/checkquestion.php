<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$qID=$_POST['Question_ID'];

$query=mysqli_query($con, "SELECT * FROM like_questions WHERE user_ID='$uID' AND question_ID='$qID'");
$match  = mysqli_num_rows($query);

    while($g = mysqli_fetch_object($query)){
        $q_like = $g->question_like;
    }


    if($match == 0 || $q_like == 0)
    {
        echo json_encode(0);
        die();

    }
    else
    {
        echo json_encode(1);
        die();
    }
?>