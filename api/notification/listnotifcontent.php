<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];

    $query = mysqli_query($con, "SELECT * FROM `notification` WHERE user_id=$uID AND n_read='1' ORDER BY n_id DESC LIMIT 10");

    $arr=array();

    while($a = mysqli_fetch_object($query)){

        $question_ID = $a->question_id;
        $like_ID = $a->like_id;
        $likeadv_ID = $a->likeadv_id;
        $follow_ID = $a->follow_id;
        $userID = $a->user_id;
        $userID2 = $a->user_id2;
        $Name = $a->name;

        $query2 = mysqli_query($con, "SELECT * FROM profile_pics WHERE user_ID=$userID2");
        
        while($b = mysqli_fetch_object($query2)){
            $p_Image = $b->profileImage;
        }

        array_push($arr, array("Question_ID" => $question_ID, 
        "user_ID" => $userID, "user_ID2" => $userID2, "name" => $Name, "pImage" => "<img src = $p_Image>", 
        "likeid" => $like_ID, "likeadvID" => $likeadv_ID, "followid" => $follow_ID));

        }
    
    
    echo json_encode($arr);
    die();

?>