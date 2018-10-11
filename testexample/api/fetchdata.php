<?php
	include "db.php";

    $dataquery = mysqli_query($con, "SELECT * FROM course_details");

    $arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("title" => $r->title, "duration" => $r->duration, "price" => $r->price));
    }

    //print_r(json_encode($arr));
    echo json_encode($arr);

?>