<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    $Question_ID = $_POST["Question_ID"];

    //GRAB THE USER FIRST NAME AND LAST NAME
    $uNAME = $_SESSION['f_name'];
    $lNAME = $_SESSION['l_name'];

    //UPDATES USER NAME COLUMN FOR ADVICE TABLE GIVEN IN THE DATABASE
    mysqli_query($con, "UPDATE `advice` SET f_name='$uNAME', l_name='$lNAME' WHERE question_id='$Question_ID'");

    //QUERY TO SELECT ALL FROM THE ADVICE TABLE WITH SPECIFIC QUESTION ID
    $dataquery = mysqli_query($con, "SELECT * FROM advice WHERE question_id='$Question_ID'");
    $arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("advice" => $r->advice, "f_name" => $r->f_name, "l_name" => $r->l_name));
    }
    echo json_encode($arr);
?>