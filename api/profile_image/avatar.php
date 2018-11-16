<?php
	include "../Account/db.php";
	$User_ID = $_SESSION['user_ID'];

	$q=mysqli_query($con, "SELECT profileImage FROM profile_pics WHERE user_ID='$User_ID'");
    
    if($q->num_rows == 0 || $q == NULL){
		$avatar = "<img src = ../profile_pic/default.png>";
		$arr = array();
		array_push($arr, array("pImage" => "$avatar"));
	}
	else{
		$query = mysqli_query($con, "SELECT profileImage FROM profile_pics WHERE user_ID='$User_ID'");
		 $arr = array();
		 while($r = mysqli_fetch_object($query)){
			$p_Image = $r->profileImage;
			array_push($arr, array("pImage" => "<img src = $p_Image>"));
			
		}
	}
	echo json_encode($arr);
	die();

?>