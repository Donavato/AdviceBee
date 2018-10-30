<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    //Pull all questions the current logged in user has made
    $user_ID = $_SESSION['user_ID'];
    
    $dataquery = mysqli_query($con, "SELECT * FROM Questions WHERE user_ID='$user_ID'");
    $arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("Question_ID" => $r->Question_ID, "Description" => $r->Description, "Subject" => $r->Subject));
    }
    echo json_encode($arr);
    die();
?>
