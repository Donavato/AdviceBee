<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	$age = mysqli_real_escape_string($con, $_POST['storeAge'];
	
	//query table to update it with new location
	mysqli_query($con,
	"UPDATE `users` 
	SET `age` = '$age' 
	WHERE `users`.`user_ID` = $user_ID");

	echo json_encode("Age successfully changed");
	die();
?>