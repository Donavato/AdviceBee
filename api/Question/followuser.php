<?php
include "../Account/db.php";

$qID = $_POST["qID"];
$uID = $_SESSION['user_ID'];
$uID2 = $_POST["uID2"];

//FETCH DATA FROM QUESTIONS TABLE
$a_data = mysqli_query($con, "SELECT * FROM questions WHERE Question_ID=$qID AND user_id=$uID2");

//STORE ANONYMOUS DATA INTO VARIABLE
while($f = mysqli_fetch_object($a_data)){
    $anonymous = $f->anonymous;

    //IF QUESTION IS ANONYMOUS CANT FOLLOW USER
    if($anonymous == 1){

        echo json_encode("Cannot follow user");

    }
    //IF QUESTION NOT ANONYMOUS PROCEED
    else{
    
        //FETCH DATA FROM FOLLOW_USER TABLE
        $query=mysqli_query($con, "SELECT * FROM follow_user WHERE user_ID1='$uID' AND user_ID2='$uID2'");
        $match  = mysqli_num_rows($query);
        
        //STORE DATA INTO VARIABLE
        while($g = mysqli_fetch_object($query)){
            $u_follow = $g->u_follow;
        }

        //IF FOUND AND ANONYMOUS = 1
        if($match > 0 && $anonymous == 1){
            echo json_encode("Cannot follow user!");
            die();

        }
        //IF FOUND AND U_FOLLOW = 0, SET U_FOLLOW=1
        else if($match > 0 && $u_follow == 0){
            mysqli_query($con, "UPDATE follow_user SET u_follow='1' WHERE user_ID1='$uID' AND user_ID2='$uID2'");
            echo json_encode("Followed User!");
            die();

        }
        //IF FOUND, SET U_FOLLOW = 0
        else if($match > 0){
            mysqli_query($con, "UPDATE follow_user SET u_follow='0' WHERE user_ID1='$uID' AND user_ID2='$uID2'");
            echo json_encode("Unfollowed User!");
            die();

        }
        //IF NOT FOUND PROCEED
        else{
            //INSERT INTO FOLLOW_USER TABLE WITH PROVIDED DATA
            mysqli_query($con,"INSERT INTO follow_user (`user_ID1`,`user_ID2`,`u_follow`) VALUES ('$uID','$uID2','1')");
        
            //GRAB DATA FOR NOTIFICAION TABLE FROM FOLLOW_USER TABLE
            $data=mysqli_query($con, "SELECT * FROM follow_user WHERE user_ID1='$uID' AND user_ID2='$uID2'");
            
            //STORE DATA INTO VARIABLES
            while($r = mysqli_fetch_object($data)){
                $follow_ID = $r->follow_id;
                $userID = $r->user_id2;
        
                $data3 = mysqli_query($con, "SELECT * FROM users WHERE user_id='$uID'");
                while($c = mysqli_fetch_object($data3)){
                    $fname = $c->f_name;
                    $lname = $c->l_name;
                    $Name = $fname . ' ' . $lname;
                }
        
            }
        
            //CHECK IF USER ISNT CURRENT SESSION USER THEN INSERT INTO NOTIFICATION TABLE WITH PROVIDED DATA
            if($uID != $userID){
                $q=mysqli_query($con,"INSERT INTO `notification` (`follow_id`, `user_id`, `user_id2`, `name`) VALUES ('$follow_ID', '$uID2', '$uID', '$Name')");
                echo json_encode("Followed User!");
                die();
            }
               
        }

    }

}

?>