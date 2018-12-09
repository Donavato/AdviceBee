<?php
    include "../Account/db.php";

    $qID = $_POST["question_id"];
    $uID = $_SESSION['user_ID'];
    $uID2 = $_POST["userID2"];

    $query =  mysqli_query($con, "SELECT * FROM question_views WHERE user_id=$uID AND question_id=$qID");

    $result = intval(mysqli_num_rows($query));

    if($uID2 == $uID)
    {
    }
    else
    {
        if($result > 0)
        {
        }
        else
        {
            mysqli_query($con, "INSERT INTO `question_views`(`user_id`, `question_id`) VALUES ($uID, $qID)");
            $result = $result + 1;
            mysqli_query($con, "UPDATE questions SET views = $result WHERE `Question_ID` = $qID");
        }
    }

    die();

?>