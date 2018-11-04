<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    $Question_ID = $_POST["Question_ID"];

    //QUERY TO SELECT ALL FROM THE ADVICE TABLE WITH SPECIFIC QUESTION ID
    $datastring = mysqli_query($con, "SELECT * FROM advice WHERE question_id='$Question_ID'");
    $arr = array();

    while($r = mysqli_fetch_object($datastring)){
        $user_ID = $r->user_id;
        $advice = $r->advice;
        $advice_ID = $r->advice_id;

        $query = mysqli_query($con, "SELECT f_name, l_name FROM users WHERE user_ID='$user_ID'");

        while($z = mysqli_fetch_object($query)){
            $fname = $z->f_name;
            $lname = $z->l_name;
            $Name = $fname . ' ' . $lname;
            array_push($arr, array("advice" => $advice, "name" => $Name, "advice_id" => $advice_ID));
        }
    }
    echo json_encode($arr);
    die();
?>