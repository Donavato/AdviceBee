<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];

	//get topic id and name the user is following
	$result = mysqli_query($con, 
	"SELECT t2.group_id, t2.group_name, t2.GroupImage 
	FROM subtopic AS t2 INNER JOIN user_subtopic AS t1 ON (t2.group_id = t1.group_id) 
	WHERE t1.user_ID = '$user_ID'");

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