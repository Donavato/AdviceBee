<?php
	include "../Account/db.php";
	
	$topicName = $_POST['Topic_Name'];
	
	//query the database to get all the questions for a specific topic
	$dataquery=mysqli_query($con, 
	"SELECT * 
	FROM Questions 
	WHERE topic = '$topicName'");
	
	$arr = array();
    while($r = mysqli_fetch_object($dataquery)){
        array_push($arr, array("Question_ID" => $r->Question_ID, "Description" => $r->Description, "Subject" => $r->Subject, "anonymous" => $r->anonymous, "hide" => $r->hide, "user_ID2" => $r->user_id));

    }
	
	echo json_encode($arr);
    die();

?>