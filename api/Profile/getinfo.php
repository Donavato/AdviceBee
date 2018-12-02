<?php
	include "../Account/db.php";
	
	//grab profile id we want to call
	if(isset($_POST['profileID']))
	{
		$profileID = $_POST['profileID'];
	}
	else
	{
		//store user id from session into variable
		$profileID=$_SESSION['user_ID'];
	}

	//get info of the user with the selected ID
	$result = mysqli_query($con, "SELECT * FROM users WHERE user_ID = '$profileID'");
	$following = mysqli_query($con, "SELECT * FROM `follow_user` WHERE user_id1 = '$profileID'");
	$followers = mysqli_query($con, "SELECT * FROM `follow_user` WHERE user_id2 = '$profileID'");
	$adviceposts = mysqli_query($con, "SELECT * FROM advice WHERE user_id = '$profileID'");
	$questionposts = mysqli_query($con, "SELECT * FROM questions WHERE user_id = '$profileID'");
	$following = mysqli_num_rows($following);
	$followers = mysqli_num_rows($followers);
	$adviceposts = mysqli_num_rows($adviceposts);
	$questionposts = mysqli_num_rows($questionposts);
	$posts = $adviceposts + $questionposts;

	//storing data recieved into an array
	$data = array();
	while ($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
		array_push($data, array("following" => $following));
		array_push($data, array("followers" => $followers));
		array_push($data, array("posts" => $posts));
	}

	//returning response in JSON format
	echo json_encode($data);
	die();
?>