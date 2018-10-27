<?php

	$topicID = $_POST['topicStoreID'];
	
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table
	mysqli_query($conn,
	"INSERT INTO user_topic (user_id, topic_id)
	VALUES ('1', $topicID)");
?>