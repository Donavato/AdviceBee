<?php

	$topicID = $_POST['topicStoreID'];
	
	//connecting to database
	$conn = mysqli_connect("localhost", "root", "", "advicebee");
	
	//querying table
	mysqli_query($conn, 
	"DELETE 
	FROM user_topic
	WHERE user_id = 1 AND topic_id = $topicID");
?>