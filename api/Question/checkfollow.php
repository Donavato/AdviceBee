<?php
include "../Account/db.php";

$qID = $_POST["qID"];
$uID = $_SESSION['user_ID'];
$uID2 = $_POST["uID2"];

$a_data = mysqli_query($con, "SELECT * FROM questions WHERE Question_ID=$qID AND user_id=$uID2");

while($f = mysqli_fetch_object($a_data))
{
    $anonymous = $f->anonymous;

    if($anonymous == 1)
    {

        echo json_encode(0);

    }
    else
    {
    
        $query=mysqli_query($con, "SELECT * FROM follow_user WHERE user_ID1='$uID' AND user_ID2='$uID2'");
        $match  = mysqli_num_rows($query);
        
        while($a = mysqli_fetch_object($query)){
            $u_follow = $a->u_follow;
        }

            if($match > 0 && $anonymous == 1){
                echo json_encode(0);
                die();
            }
            else if($match > 0 && $u_follow==1)
            {
                echo json_encode(1);
                die();
            }
            else
            {
                echo json_encode(0);
            }
    }
}