<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	$title = $_POST["userTitle"];
	
	//query table to update it with new title
	mysqli_query($con,
	"UPDATE `users` 
	SET `title` = '$title' 
	WHERE `users`.`user_ID` = $user_ID");

	echo json_encode("Title successfully changed");
	die();
?>