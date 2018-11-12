<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$aID=$_POST['advice_ID'];

$query=mysqli_query($con, "SELECT * FROM like_advices WHERE advice_ID='$aID' AND user_ID='$uID'");
$match = mysqli_num_rows($query);

    while($r = mysqli_fetch_object($query)){
        $like_aID = $r->likeadv_ID;
        $adviceID = $r->advice_ID;
        $userID = $r->user_ID;
        $a_like = $r->advice_like;
    }

    if($match > 0 && $a_like == 0){
        mysqli_query($con, "UPDATE like_advices SET advice_like='1' WHERE advice_ID=$aID AND user_ID=$userID");
        echo json_encode("Advice Liked!");
        die();
    }
    else if ($match > 0){
        mysqli_query($con, "UPDATE like_advices SET advice_like='0' WHERE advice_ID=$aID AND user_ID=$userID");
        echo json_encode("Advice unliked!");
        die();
    }
    else{
        mysqli_query($con,"INSERT INTO like_advices (`advice_ID`,`user_ID`,`advice_like`) VALUES ('$aID','$uID','1')");
        echo json_encode("Advice Liked!");
        die();
    }

 ?>