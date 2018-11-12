<?php 
    include "Account/db.php";
    header('Content-type: application/json');

    //Search items that the user is looking for
    $search_items = trim($_POST['Data']);
    
    //Create three queries to search DB and retrieve data
    $find_data_Questions = mysqli_query($con, "SELECT * FROM `Questions` WHERE LOWER(`Subject`) LIKE LOWER('%$search_items%')");
    $find_data_Users = mysqli_query($con, "SELECT * FROM `users` WHERE LOWER(`f_name`) LIKE LOWER('%$search_items%')");
    $find_data_Advices = mysqli_query($con, "SELECT * FROM `advice` WHERE LOWER(`advice`) LIKE LOWER('%$search_items%')");
    
    //Store data retrieved in JSON array that you can send back
    $arr_Questions = array();
    while($r = mysqli_fetch_object($find_data_Questions)){
        array_push($arr_Questions, array("Description" => $r->Description, "Subject" => $r->Subject));
    }
    $arr_Users = array();
    while($x = mysqli_fetch_object($find_data_Users)){
        array_push($arr_Users, array("f_name" => $x->f_name, "l_name" => $x->l_name, "email" => $x->email));
    }
    $arr_Advices = array();
    while($y = mysqli_fetch_object($find_data_Advices)){
        array_push($arr_Advices, array("advice"=> $y->advice,"advice_id" => $y->advice_id, "user_id" => $y->user_id));
    }

    $arr_All = array();
    array_push($arr_All, array("Questions"=>$arr_Questions,"Users"=>$arr_Users, "Advice"=>$arr_Advices));
    
    echo json_encode($arr_All);
    die();
    

    

?>