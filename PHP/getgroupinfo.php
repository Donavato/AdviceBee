<?php
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table for all group names
	$result = mysqli_query($conn, 
	"SELECT group_name,group_id
	FROM subtopic");
	
	//store results into array
	$data = array();
	
	while($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}
	
	//returning in JSON format
	echo json_encode($data);

?>