<?php
	include "../Account/db.php";
	$User_ID = $_SESSION['user_ID'];
	
	mysqli_query($con, "UPDATE `users` SET `fts` = '1' WHERE user_ID='$User_ID'");
	die();
?>