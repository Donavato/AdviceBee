<?php

//connect to database
$conn = mysqli_connect("localhost", "root", "", "advicebee");

//get data from table
$result = mysqli_query($conn, "SELECT * FROM user WHERE user_id = 1");

//storing data recieved into an array
$data = array();
while ($row = mysqli_fetch_assoc($result))
{
	$data[] = $row;
}

//returning response in JSON format
echo json_encode($data);

?>