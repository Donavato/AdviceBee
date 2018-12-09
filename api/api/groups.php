<?php
    include "Account/db.php";
    header('Content-type: application/json');

    //set user ID of session
    $user_ID=$_SESSION['user_ID'];

    //use query to grab all groups user is following
    $dataquery = $con->query("SELECT t2.group_name
	FROM subtopic AS t2 INNER JOIN user_subtopic AS t1 ON (t2.group_id = t1.group_id) 
    WHERE t1.user_ID = '$user_ID'");

    //put all group names collected from database into an array
    if($dataquery->num_rows > 0) {
        while($row = $dataquery->fetch_assoc()){
            $groups_arr[] = $row["group_name"];
        } 
    }else{
        echo "No groups";
    }
    
    //send back the array
    echo json_encode($groups_arr);
?>