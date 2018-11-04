<?php
    include "../Account/db.php";
    header('Content-type: application/json');
    $dataquery = mysqli_query($con, "SELECT * FROM Questions");
    $arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("Question_ID" => $r->Question_ID, "Description" => $r->Description, 
        "Subject" => $r->Subject, "user_ID2" => $r->user_id));
    }
    echo json_encode($arr);
?>