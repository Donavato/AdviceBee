<?php
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table for group names user is in
	$result = mysqli_query($conn, 
	"SELECT topic_id
	FROM user_topic
	WHERE user_id = 1");
	
	//store results into array
	$userdata = array();
	
	while($row = mysqli_fetch_assoc($result))
	{
		$userdata[] = $row;
	}
	
	//returning in JSON format
	echo json_encode($userdata);

?>