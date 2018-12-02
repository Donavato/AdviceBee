<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    //INSERT ADVICE ON SELECTED QUESTION
    $advice = $_POST["advice"];
    $Question_ID = $_POST["Question_ID"];
    $uID = $_SESSION['user_ID'];
    $active = $_SESSION['active'];

    //CHECK TO SEE IF USER IS VERIFIED, IF SO, PROCEED
    if($active == '1'){
        //FETCH USER ID FROM QUESTIONS TABLE
        $data = mysqli_query($con, "SELECT * FROM questions WHERE Question_ID='$Question_ID'");
        while($a = mysqli_fetch_object($data)){
            $userID = $a->user_id;
        }

        //FETCH USER NAME FROM USERS TABLE
        $data2 = mysqli_query($con, "SELECT * FROM users WHERE user_id=$uID");
        while($b = mysqli_fetch_object($data2)){
            $fname = $b->f_name;
            $lname = $b->l_name;
            $Name = $fname . ' ' . $lname;
        }

        //notification query and check so that user that owns the question wont get a notfication if respond to their question
        if($uID != $userID){
            mysqli_query($con,"INSERT INTO `notification` (`question_id`,`user_id`, `user_id2`, `name`) VALUES ('$Question_ID','$userID', '$uID', '$Name')");
        }

        //INSERT INTO ADVICE TABLE WITH THE DATA FETCHED
        $dataquery = mysqli_query($con,"INSERT INTO `advice` (`advice`,`question_id`, `user_id`) VALUES ('$advice','$Question_ID', '$uID')");
        
        //ERROR CHECK IN CASE INSERT QUERY FAILS
        if($dataquery){
            echo json_encode("success");
            die();
        }
        else{
            echo(mysqli_error($con));
            echo json_encode("error");
            die();
        }
    }
    else{
        echo json_encode("You have not verified your email");
        die();
    }

?>