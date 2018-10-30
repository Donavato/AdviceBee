<?php
	include "db.php";
    header('Content-type: application/json');
    $email = $_POST['email'];
    $email =  strtolower($email);
    $passwrd = $_POST['passwrd'];
    
    //database email comparison to find if email exists
    $result = $con->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows == 0){ //if the user doesnt exist
        $_SESSION['logged_in'] = false;
        $loggedIn = $_SESSION['logged_in'];
        echo json_encode($loggedIn);
        die();  
    }   
    else{ //user exists
        $user = $result->fetch_assoc();

        //found issue. Issue was that stored hashed passwords used different hashing method.(WAMP hashing type is different than password_hash() type.)
        if(password_verify($passwrd, $user['passwrd'])){ //Verify the password entered
            //if password correct, link information from DB to session variables
            $_SESSION['f_name']= $user['f_name'];            //user first name
            $_SESSION['l_name']= $user['l_name'];            //user last name
            $_SESSION['email']= $user['email'];              //user email
            $_SESSION['user_ID'] = $user['user_ID'];         //user ID
            $_SESSION['active'] = $user['active'];           //has user verified their email
            
            //Will be used to check if users session is logged in/allowed to do things
            $_SESSION['logged_in'] = true;  
        }
        else{
            $_SESSION['message'] = "You have entered the wrong password, please try again";
            $_SESSION['logged_in'] = false;
            $response = "not logged in";
        }
        $loggedIn = $_SESSION['logged_in'];
        echo json_encode($loggedIn);
        die();
    }        
?>
