<?php

	$groupID = $_POST['groupStoreID'];
	
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table for group names user is in
	mysqli_query($conn, 
	"DELETE 
	FROM user_subtopic
	WHERE user_id = 1 AND group_id = $groupID");
?>