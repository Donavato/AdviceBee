<?php

	$groupID = $_POST['groupStoreID'];
	
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table
	mysqli_query($conn,
	"INSERT INTO user_subtopic (user_id, group_id)
	VALUES ('1', $groupID)");
?>