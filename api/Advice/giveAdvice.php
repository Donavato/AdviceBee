<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    
    $advice = $_POST["advice"];
    $Question_ID = $_POST["Question_ID"];
    $dataquery = mysqli_query($con,"INSERT INTO `advice` (`advice`,`question_id`) VALUES ('$advice','$Question_ID')");
    
    if($dataquery){
        echo json_encode("success");
        die();
    }
    else{
        
        echo json_encode("error");
        die();
        echo(mysqli_error($con));
    }

?>