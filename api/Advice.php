<?php
    include "db.php";
    header('Content-Type: application/json');
    $Question_ID = $_POST["Question_ID"];

    $result = $con->query("SELECT * FROM Questions WHERE Question_ID='$Question_ID'");
    if($result->num_rows == 0){
        $output = "Doesnt Work!";
        
        echo json_encode($output);
        die();
    }
    else{
        $output = "Works!";
        echo json_encode($output);
        die();
    }

?>