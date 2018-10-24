<?php
	include "db.php";
    header('Content-type: application/json');
    $email = $_POST['email'];
    $email =  strtolower($email);
    $passwrd = $_POST['passwrd'];
    
    //database email comparison to find if email exists
    $result = $con->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows == 0){ //if the user doesnt exist
        $_SESSION['message'] = "user doesnt exist";
        echo "<br> user doesnt exist <br>";
    }   
    else{ //user exists
        echo "<br>user exists <br>";
        $user = $result->fetch_assoc();

        //found issue. Issue was that stored hashed passwords used different hashing method.(WAMP hashing type is different than password_hash() type.)
        if(password_verify($passwrd, $user['passwrd'])){ //Verify the password entered
            echo "Logged in <br>";
            //if password correct, link information from DB to session variables
            $_SESSION['f_name']= $user['f_name'];
            $_SESSION['l_name']= $user['l_name'];
            $_SESSION['email']= $user['email'];
            // has user verified email
            //$_SESSION['authorized']= $user['authorized'];

            //spit data to test
            $fname = $_SESSION['f_name'];
            $lname = $_SESSION['l_name'];
            $uemail = $_SESSION['email'];
            echo "Session Data is as follows: <br>";
            echo "First name: $fname <br> Last name: $lname <br> Email: $uemail <br>";
            //Will be used to check if users session is logged in/allowed to do things
            $_SESSION['logged_in'] = true;
            //return to Success
            return $_SESSION['logged_in'];     
            exit("Success");
           
        }
        else{
            $_SESSION['message'] = "You have entered the wrong password, please try again";
            $_SESSION['logged_in'] = false;
            echo "not logged in <br>";
        }
    }          
?>
