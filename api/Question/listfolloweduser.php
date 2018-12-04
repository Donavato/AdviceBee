<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];

//SELECT ALL USERS THAT ARE FOLLOWED FROM SESSION USER
$datastring = mysqli_query($con, "SELECT * FROM follow_user WHERE user_id1='$uID' AND u_follow='1'");

//CREATE EMPTY ARRAY
$arr = array();

//FETCH ALL DATA NEEDED FROM FOLLOW_USER
while($r = mysqli_fetch_object($datastring)){
    $uID2 = $r->user_id2;
    $follow_ID = $r->follow_id;

    //FETCH NAME OF THE USER
    $query = mysqli_query($con, "SELECT f_name, l_name FROM users WHERE user_ID='$uID2'");

    while($z = mysqli_fetch_object($query)){
        $fname = $z->f_name;
        $lname = $z->l_name;
        $Name = $fname . ' ' . $lname;

        //FETCH PROFILE IMAGE OF THE USER
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