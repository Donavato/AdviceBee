<?php
include "../Account/db.php";

$qID = $_POST["qID"];
$uID = $_SESSION['user_ID'];
$uID2 = $_POST["uID2"];

$a_data = mysqli_query($con, "SELECT * FROM questions WHERE Question_ID=$qID AND user_id=$uID2");

while($f = mysqli_fetch_object($a_data)){
    $anonymous = $f->anonymous;

    if($anonymous == 1){

        echo json_encode("Cannot follow user");

    }else{
    
        $query=mysqli_query($con, "SELECT * FROM follow_user WHERE user_ID1='$uID' AND user_ID2='$uID2'");
        $match  = mysqli_num_rows($query);
        
        if($match > 0 && $anonymous == 1){
            echo json_encode("Cannot follow user!");
            die();
        }else if($match > 0){
            echo json_encode("You have already followed this user!");
            die();
        }else{
            mysqli_query($con,"INSERT INTO follow_user (`user_ID1`,`user_ID2`) VALUES ('$uID','$uID2')");
        
            $data=mysqli_query($con, "SELECT * FROM follow_user WHERE user_ID1='$uID' AND user_ID2='$uID2'");
            
            while($r = mysqli_fetch_object($data)){
                $follow_ID = $r->follow_id;
                $userID = $r->user_id2;
        
                $data3 = mysqli_query($con, "SELECT * FROM users WHERE user_id=$uID");
                while($c = mysqli_fetch_object($data3)){
                    $fname = $c->f_name;
                    $lname = $c->l_name;
                    $Name = $fname . ' ' . $lname;
                }
        
            }
        
            if($uID != $userID){
                mysqli_query($con,"INSERT INTO `notification` (`follow_id`, `user_id`, `user_id2`, `name`) VALUES ('$follow_ID', '$uID2', '$uID', '$Name')");
            }
            
            echo json_encode("Followed User!");
            die();
        }

    }
}

?>