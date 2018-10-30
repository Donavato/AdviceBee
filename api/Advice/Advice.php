<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    //FORMAT ADVICE 
    $Question_ID = $_POST["Question_ID"];
    
    $dataquery = mysqli_query($con, "SELECT * FROM Questions WHERE Question_ID='$Question_ID'");
    
    if($dataquery->num_rows == 0){
        $output = "Question not found!";
        
        echo json_encode($output);
        die();
    }
    else{
        $arr = array();
        while($r = mysqli_fetch_object($dataquery)){
            array_push($arr, array("Question_ID" => $r->Question_ID, "Description" => $r->Description, "Subject" => $r->Subject, "topic" => $r->topic, "question_type" => $r->question_type));
        }
        echo json_encode($arr);
        die();
    }

?>