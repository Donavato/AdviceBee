<?php
include "../Account/db.php";

$uID = $_SESSION['user_ID'];
$qID=$_POST['Question_ID'];
$email = "advicebeemod@gmail.com";

//CHECK TO SEE IF THE USER HAS ALREADY REPORTED THE QUESTION
$check=mysqli_query($con, "SELECT * FROM `report` WHERE question_id='$qID' AND user_id='$uID' AND reported='1'");
$match=mysqli_num_rows($check);

//IF USER ALREADY REPORTED PROCEED
if($match > 0){
    echo json_encode("already reported");

}
//IF USER HASNT REPORTED PROCEED
else{
    //INSERT DATA INTO REPORT TABLE
    mysqli_query($con,"INSERT INTO `report` (`question_id`, `user_id`, `reported`) VALUES ('$qID', '$uID', '1')");
    
    //GRAB USER NAME AND EMAIL AND STORE INTO VARIABLES
    $data=mysqli_query($con, "SELECT f_name, l_name, email FROM users WHERE user_ID='$uID'");
    while($a = mysqli_fetch_object($data)){
        $f_NAME = $a->f_name;
        $l_NAME = $a->l_name;
        $userName = $f_NAME . ' ' . $l_NAME;
        $userEmail = $a->email;
    }

    //GRAB EMAIL INFORMATION OF THE QUESTION REPORTED AND STORE INTO VARIABLES
    $query=mysqli_query($con,"SELECT * FROM questions WHERE Question_ID='$qID'");

    while($r = mysqli_fetch_object($query)){
        $topic = $r->topic;
        $q_subject = $r->Subject;
        $description = $r->Description;
        $ownerID = $r->user_id;

            $query2 = mysqli_query($con, "SELECT f_name, l_name, email FROM users WHERE user_ID='$ownerID'");

            while($z = mysqli_fetch_object($query2)){
                $fname = $z->f_name;
                $lname = $z->l_name;
                $ownerName = $fname . ' ' . $lname;
                $ownerEmail = $z->email;

            }
        }


    //EMAIL FOR QUESTION REPORTED
    $to = $email; // Send email to our MODERATOR OR ADMIN
    $subject = 'AdviceBee | Question Reported'; // Give the email a subject 

    // THE CONTENT OF THE EMAIL
    $message = "
    The Following Question has been reported.
    
    Question ID: $qID
    Owner: $ownerName
    Owner Email: $ownerEmail

    Topic: $topic
    Subject: $q_subject
    Description:
    $description

    Reported by: $userName
    User ID: $uID
    Email: $userEmail
    
    ";

    // PHP MAIL FUNCTION to Send our email
    $headers = 'From:noreply@AdviceBee.com' . "\r\n"; // Set headers *need headers* to send mail
    mail($to, $subject, $message, $headers);

    echo json_encode("Question has been reported!");
    die();

}
 ?>