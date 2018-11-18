<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$qID=$_POST['Question_ID'];

$query=mysqli_query($con, "SELECT * FROM like_questions WHERE user_ID='$uID' AND question_ID='$qID'");
$match  = mysqli_num_rows($query);

    while($g = mysqli_fetch_object($query)){
        $q_like = $g->question_like;
    }


    if($match > 0 && $q_like == 0){
        mysqli_query($con, "UPDATE like_questions SET question_like='1' WHERE user_ID='$uID' AND question_ID='$qID'");
        echo json_encode("Question Liked!");
        die();

    }else if($match > 0){
        mysqli_query($con, "UPDATE like_questions SET question_like='0' WHERE user_ID='$uID' AND question_ID='$qID'");
        echo json_encode("Question unliked!");
        die();

    }else{

        //PERSON WHO OWNS THE QUESTION
        $data2 = mysqli_query($con, "SELECT * FROM questions WHERE Question_ID='$qID'");
        while($b = mysqli_fetch_object($data2)){
            $userID = $b->user_id;
        }

        //YOUR NAME
        $data3 = mysqli_query($con, "SELECT * FROM users WHERE user_id=$uID");
        while($c = mysqli_fetch_object($data3)){
            $fname = $c->f_name;
            $lname = $c->l_name;
            $Name = $fname . ' ' . $lname;
        }

        //INSERT INTO LIKE QUESTIONS TABLE
        mysqli_query($con,"INSERT INTO `like_questions` (`user_ID`,`question_ID`,`question_like`) VALUES ('$uID','$qID','1')");


        //GET LIKE_ID
        $data = mysqli_query($con, "SELECT * FROM like_questions WHERE user_ID='$uID' AND question_ID='$qID'");
        while($a = mysqli_fetch_object($data)){
            $likeID = $a->like_ID;
        }

        //notification query and check
        if($uID != $userID){
            mysqli_query($con,"INSERT INTO `notification` (`question_id`, `like_id`, `user_id`, `user_id2`, `name`) VALUES ('$qID', '$likeID', '$userID', '$uID', '$Name')");
        }

        echo json_encode("Question Liked!");
        die();
    }

 ?>