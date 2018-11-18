<?php
	include "../Account/db.php";
	
	//grab profile id we want to call
	if(isset($_POST['profileID']))
	{
		$profileID = $_POST['profileID'];
	}
	else
	{
		//store user id from session into variable
		$profileID=$_SESSION['user_ID'];
	}

	//get info of the user with the selected ID
	$result = mysqli_query($con, "SELECT * FROM users WHERE user_ID = '$profileID'");

	//storing data recieved into an array
	$data = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}

	//returning response in JSON format
	echo json_encode($data);
	die();
?>