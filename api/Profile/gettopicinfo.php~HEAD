<?php
	include "../Account/db.php";
	
	//querying topics table for topic name and topic id
	$result = mysqli_query($con, 
	"SELECT Topic_name, Topic_ID
	FROM topics");
	
	//store results into array
	$data = array();
	
	while($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}
	
	//returning in JSON format
	echo json_encode($data);

?>