<?php
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table
	$result = mysqli_query($conn, 
	"SELECT topic_name, topic_id
	FROM topic");
	
	//store results into array
	$data = array();
	
	while($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}
	
	//returning in JSON format
	echo json_encode($data);

?>