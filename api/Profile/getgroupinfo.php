<?php
	include "../Account/db.php";
	
	//querying table for all group names
	$result = mysqli_query($con, 
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