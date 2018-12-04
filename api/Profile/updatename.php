<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	$first_name = mysqli_real_escape_string($con, $_POST["userfirstName"]);
	$last_name = mysqli_real_escape_string($con, $_POST["userlastName"]);
	
	//query table to update it with new first and last name
	mysqli_query($con,
	"UPDATE `users` 
	SET `f_name` = '$first_name', `l_name` = '$last_name' 
	WHERE `users`.`user_ID` = $user_ID");

	echo json_encode("Name successfully changed");
	die();
?>