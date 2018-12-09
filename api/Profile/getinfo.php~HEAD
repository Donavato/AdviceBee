<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];

	//get info of the user with the selected ID
	$result = mysqli_query($con, "SELECT * FROM users WHERE user_ID = '$user_ID'");

	//storing data recieved into an array
	$data = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}

	//returning response in JSON format
	echo json_encode($data);

?>