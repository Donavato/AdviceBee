<?php
	include "../Account/db.php";
	
	//store user id from session into variable
	if(isset($_SESSION['user_ID']))
	{
		$user_ID =$_SESSION['user_ID'];
	}
	
	echo json_encode($user_ID);
	die();
?>