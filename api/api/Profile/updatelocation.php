<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	$location = mysqli_real_escape_string($con, $_POST['userLocation']);
	
	//query table to update it with new location
	mysqli_query($con,
	"UPDATE `users` 
	SET `location` = '$location' 
	WHERE `users`.`user_ID` = $user_ID");

	echo json_encode("Location successfully changed");
	die();
?>