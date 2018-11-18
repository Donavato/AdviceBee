<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];

if(isset($_POST['view'])){
    
    //CHECK
    if($_POST["view"] == "read")
    {
        mysqli_query($con, "UPDATE `notification` SET n_read='1' WHERE user_id=$uID AND n_read='0'");
    }

    //UPDATES ICON BADGE COUNT
    $result_query = mysqli_query($con, "SELECT * FROM notification WHERE user_id=$uID AND n_read='0'");
    $count = mysqli_num_rows($result_query);

    //CHECK IF USER HAS NOTIFICATION
    $check = mysqli_query($con, "SELECT user_id FROM `notification` WHERE user_id=$uID AND n_read='0'");
    if(mysqli_num_rows($check) > 0){

            $data = array('unread_notification' => $count);
    
            echo json_encode($data);

    }else{
        $data = array(
            'unread_notification' => $count
        );
        echo json_encode($data);
    }

}

?>