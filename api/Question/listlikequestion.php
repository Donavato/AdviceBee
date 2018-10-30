<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];

$datastring = mysqli_query($con, "SELECT * FROM like_posts WHERE user_ID='$uID'");
$arr = array();

while($r = mysqli_fetch_object($datastring)){
    $qID = $r->question_ID;

    $query = mysqli_query($con, "SELECT Subject, Description, Question_ID FROM questions WHERE Question_ID='$qID'");

    while($z = mysqli_fetch_object($query)){
        $Subject = $z->Subject;
        $Description= $z->Description;
        $Question_ID= $z->Question_ID;

        array_push($arr, array("Question_ID" => $Question_ID, "Subject" => $Subject, "Description" => $Description));
    }
}

echo json_encode($arr);
die();
?>