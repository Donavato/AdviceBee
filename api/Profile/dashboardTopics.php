<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];

	//get topic id and name the user is following
	$result = mysqli_query($con, 
	"SELECT t2.Topic_ID, t2.Topic_name, t2.topicImage 
	FROM topics AS t2 INNER JOIN user_topic AS t1 ON (t2.Topic_id = t1.topic_id) 
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