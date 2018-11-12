<?php
    include "../Account/db.php";
    header('Content-Type: application/json');

    //$question = $_POST['Question_ID'];
    $question = 30;
    $dataquery = mysqli_query($con, "SELECT * FROM Questions WHERE Question_ID='$question'");
    while($row = mysqli_fetch_assoc($dataquery)){
        $views = $row["views"];
        $views+=1;
    }
    echo $views;

    $update_views = mysql_query($con, "UPDATE Questions SET views=10 WHERE Question_ID=30");
    // if($update_views){
    //     echo "success";
    //     // echo json_encode("success");
    //     // die();
    // }
    // else{
    //     echo "failed";
    //     // echo json_encode("fail");
    //     // die();
    // }
?>
