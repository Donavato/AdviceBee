<?php
    include "../Account/db.php";
    header('Content-Type: application/json');

    $Question_ID = $_POST["Question_ID"];

    $dataquery = mysqli_query($con, "SELECT * FROM multiple_choice WHERE Question_ID='$Question_ID'");
    
    if($dataquery->num_rows == 0){
        $output = "Choices not found!";
        
        echo json_encode($output);
        die();
    }
    else{
        $arr = array();

        while($r = mysqli_fetch_object($dataquery)){
            $choices = $r->option_value;
            array_push($arr, array("option_value" => $choices));
        }
        
    }
    echo json_encode($arr);
    die();
?>