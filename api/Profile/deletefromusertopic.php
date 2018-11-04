<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	$user_ID=$_SESSION['user_ID'];

	$topicID = $_POST['topicStoreID'];
	
	//Deleting from user_topic table the selected topic
	mysqli_query($con, 
	"DELETE 
	FROM user_topic
	WHERE user_ID = '$user_ID' AND topic_id = $topicID");
?>