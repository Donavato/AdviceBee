<?php
	include "../Account/db.php";

	$topicID = $_POST['topicStoreID'];
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];
	
	//adding to user_topic table selected topic
	mysqli_query($con,
	"INSERT INTO user_topic (user_id, topic_id)
	VALUES ($user_ID, $topicID)");
?>