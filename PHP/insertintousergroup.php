<?php
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table for group names user is in
	$result = mysqli_query($conn, 
	"SELECT group_name 
	FROM subtopic AS t2 INNER JOIN user_subtopic AS T1 ON(t2.group_id  = t1.group_id)
	WHERE t1.user_id = 1");
?>