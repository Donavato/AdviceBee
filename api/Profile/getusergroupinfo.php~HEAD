<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	//querying table for group id user is in
	$result = mysqli_query($con, 
	"SELECT group_id
	FROM user_subtopic
	WHERE user_id = '$user_ID'");
	
	//store results into array
	$userdata = array();
	
	while($row = mysqli_fetch_assoc($result))
	{
		$userdata[] = $row;
	}
	
	//returning in JSON format
	echo json_encode($userdata);

?>