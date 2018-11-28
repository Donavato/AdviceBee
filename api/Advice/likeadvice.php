<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$aID=$_POST['advice_ID'];

$m_query=mysqli_query($con, "SELECT * FROM like_advices WHERE advice_ID='$aID' AND user_ID='$uID'");
$match = mysqli_num_rows($m_query);

    while($g = mysqli_fetch_object($m_query)){
        $like_aID = $g->likeadv_ID;
        $adviceID = $g->advice_ID;
        $a_like = $g->advice_like;
    }

    if($match > 0 && $a_like == 0){
        mysqli_query($con, "UPDATE like_advices SET advice_like='1' WHERE advice_ID=$aID AND user_ID=$uID");
        echo json_encode("Advice Liked!");
        die();
    }
    else if ($match > 0){
        mysqli_query($con, "UPDATE like_advices SET advice_like='0' WHERE advice_ID=$aID AND user_ID=$uID");
        echo json_encode("Advice unliked!");
        die();
    }
    else{
        mysqli_query($con,"INSERT INTO like_advices (`advice_ID`,`user_ID`,`advice_like`) VALUES ('$aID','$uID','1')");

        $query=mysqli_query($con, "SELECT * FROM like_advices WHERE advice_ID='$aID' AND user_ID='$uID'");

        while($r = mysqli_fetch_object($query)){
            $like_aID = $r->likeadv_ID;
            $adviceID = $r->advice_ID;

            $data2 = mysqli_query($con, "SELECT * FROM advice WHERE advice_id=$adviceID");
            while($b = mysqli_fetch_object($data2)){
                $qID = $b->question_id;
                $userID = $b->user_id;

                $data3 = mysqli_query($con, "SELECT * FROM users WHERE user_id=$uID");
                while($c = mysqli_fetch_object($data3)){
                    $fname = $c->f_name;
                    $lname = $c->l_name;
                    $Name = $fname . ' ' . $lname;
                }

            }

        }

        if($uID != $userID){
            mysqli_query($con,"INSERT INTO `notification` (`question_id`, `likeadv_id`, `user_id`, `user_id2`, `name`) VALUES ('$qID', '$like_aID', '$userID', '$uID', '$Name')");
        }

        echo json_encode("Advice Liked!");
        die();

    }

 ?>