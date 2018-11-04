<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    //INSERT ADVICE ON SELECTED QUESTION
    $advice = $_POST["advice"];
    $Question_ID = $_POST["Question_ID"];
    $uID = $_SESSION['user_ID'];
    $active = $_SESSION['active'];
	
    if($active == '1'){
        $dataquery = mysqli_query($con,"INSERT INTO `advice` (`advice`,`question_id`, `user_id`) VALUES ('$advice','$Question_ID', '$uID')");
        
		//query table to get points of user
		$points=mysqli_query($con,
		"SELECT points
		FROM users
		WHERE user_ID = $uID");
	
		//subtract points for the question submit
		$points = $points + 20;
	
		//Insert new point value back into users table for specific user
		mysqli_query($con, 
		"UPDATE users 
		SET `points` = $points 
		WHERE users.user_ID = $uID");
	
        if($dataquery){
            echo json_encode("success");
            die();
        }
        else{
            echo(mysqli_error($con));
            echo json_encode("error");
            die();
        }
    }
    else{
        echo json_encode("You have not verified your email");
        die();
    }

?>