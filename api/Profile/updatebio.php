<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	$bio = $_POST['storeBio'];
	
	//query table to update it with new location
	mysqli_query($con,
	"UPDATE `users` 
	SET `Bio` = '$bio' 
	WHERE `users`.`user_ID` = $user_ID");

	echo json_encode("Bio successfully changed");
	die();
?>