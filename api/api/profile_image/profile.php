<?php
    include "../Account/db.php";
    //header('Content-type: application/json');
    $image_data = $_POST['base64'];
    $User_ID = $_SESSION['user_ID'];

    $q=mysqli_query($con, "SELECT * FROM profile_pics WHERE user_ID='$User_ID'");
    
    if($q->num_rows == 0){
        $z=mysqli_query($con,"INSERT INTO `profile_pics` (`user_ID` , `profileImage`) VALUES ('$User_ID','$image_data')");
        if($z){
            echo json_encode($image_data);
            die();
        }
        else{
            echo json_encode("Insert Failed!");
            die();
        }
    }
    else{
        $z=mysqli_query($con,"UPDATE profile_pics SET profileImage='$image_data' WHERE user_ID=$User_ID");
        if($z){
            echo json_encode($image_data);
            die();
        }
        else{
            echo json_encode("Upload Failed!");
            die();
        }
    }
?>