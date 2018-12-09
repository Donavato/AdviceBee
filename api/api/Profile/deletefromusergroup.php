<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];

	$groupID = $_POST['groupStoreID'];
	
	//querying table for group names user is in
	mysqli_query($con, 
	"DELETE 
	FROM user_subtopic
	WHERE user_id = '$user_ID' AND group_id = $groupID");
?>