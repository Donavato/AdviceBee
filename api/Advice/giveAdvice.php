<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    
    $advice = $_POST["advice"];
    $Question_ID = $_POST["Question_ID"];
    $uID = $_SESSION['user_ID'];
    $dataquery = mysqli_query($con,"INSERT INTO `advice` (`advice`,`question_id`, `user_id`) VALUES ('$advice','$Question_ID', '$uID')");
    
    if($dataquery){
        echo json_encode("success");
        die();
    }
    else{
        echo(mysqli_error($con));
        echo json_encode("error");
        die();
    }

?>