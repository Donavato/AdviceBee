<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	//querying table for group names user is in
	$result = mysqli_query($con, 
	"SELECT group_name 
	FROM subtopic AS t2 INNER JOIN user_subtopic AS T1 ON(t2.group_id  = t1.group_id)
	WHERE t1.user_ID = '$user_ID'");
?>