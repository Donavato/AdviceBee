<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];

	$groupID = $_POST['groupStoreID'];
	
	//Adding to user_subtopic table which group the user clicked
	mysqli_query($con,
	"INSERT INTO user_subtopic (user_ID, group_id)
	VALUES ($user_ID, $groupID)");
?>