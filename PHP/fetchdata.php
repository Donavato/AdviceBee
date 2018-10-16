<?php
	include "db.php";

    $dataquery = mysqli_query($con, "SELECT * FROM Questions");

    $arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("Question" => $r->Question_ID, "Description" => $r->Description, "Subject" => $r->Subject));
    }

    //print_r(json_encode($arr));
    echo json_encode($arr);

?>