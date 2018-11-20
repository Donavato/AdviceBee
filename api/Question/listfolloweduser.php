<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
//$Question_ID = $_POST["Question_ID"];

$datastring = mysqli_query($con, "SELECT * FROM follow_user WHERE user_id1='$uID'");
$arr = array();

while($r = mysqli_fetch_object($datastring)){
    $uID2 = $r->user_id2;
    $follow_ID = $r->follow_id;

    $query = mysqli_query($con, "SELECT f_name, l_name FROM users WHERE user_ID='$uID2'");

    while($z = mysqli_fetch_object($query)){
        $fname = $z->f_name;
        $lname = $z->l_name;
        $Name = $fname . ' ' . $lname;

        $query2 = mysqli_query($con, "SELECT profileImage FROM profile_pics WHERE user_ID=$uID2");
        while($d = mysqli_fetch_object($query2)){
            $p_Image = $d->profileImage;

            array_push($arr, array("name" => $Name, "follow_id" => $follow_ID, "pImage" => "<img src = $p_Image>", "user_ID2" => $uID2));
        }
    }
}

echo json_encode($arr);
die();
?>