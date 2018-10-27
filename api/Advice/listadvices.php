<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    $Question_ID = $_POST["Question_ID"];

    $dataquery = mysqli_query($con, "SELECT * FROM advice WHERE question_id='$Question_ID'");
    $arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("advice" => $r->advice));
    }
    echo json_encode($arr);
?>