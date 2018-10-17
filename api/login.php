<?php
	include "db.php";
    header('Content-type: application/json');
    //$con->escape_string
    $email = $_POST['email'];
    // $email = "fk5829@wayne.edu";
    // database email comparison to find if email exists
    $result = $con->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows == 0){ //if the user doesnt exist
        $_SESSION['message'] = "user doesnt exist";
        echo ' / user not exist / ';
    }   
    else{ //user exists
        $user = $result->fetch_assoc();
        if(password_verify(isset($_POST['passwrd']), $user['passwrd'])){ //Verify the password entered
            //if password correct, link information from DB to session variables
            $_SESSION['f_name']= $user['f_name'];
            $_SESSION['l_name']= $user['l_name'];
            $_SESSION['email']= $user['email'];
            $_SESSION['authorized']= $user['authorized'];

            //Will be used to check if users session is logged in/allowed to do things
            $_SESSION['logged_in'] = true;
            //return to Success
            return $_SESSION['logged_in'];
            exit("Success");
            //output data from authorized user for testing
            $fname = $user['f_name'];
            $lname = $user['l_name'];
            $uemail = $user['email'];
            echo "$fname";
            echo "$lname";
            echo "$uemail";
        }
        else{
            $_SESSION['message'] = "You have entered the wrong password, please try again";
        }
        echo ' / user exists / ';
    }
    
    echo ' / After the check / ';
?>