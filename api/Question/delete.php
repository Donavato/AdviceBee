<?php
    include "../Account/db.php";
    header('Content-Type: application/json');

    $Question_ID = $_POST['Question_ID'];
    
    $r=mysqli_query($con,"DELETE FROM Questions WHERE Question_ID='$Question_ID'");
    
    if($r){
        echo json_encode("Question has been deleted");
        die();
    }
    else{
        echo(mysqli_error($con));
        die();
    }
    echo json_encode($Question_ID);
    die();
?>