<?php
	include "../Account/db.php";
	$User_ID = $_SESSION['user_ID'];
	
	$result = mysqli_query($con, "SELECT fts FROM users WHERE user_ID='$User_ID'");
	
	//storing data recieved into an array
	$data = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		$fts[] = $row;
	}
	
	echo json_encode($fts);
	die();
?>