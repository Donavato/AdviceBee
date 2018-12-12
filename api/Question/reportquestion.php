<?php
include "../Account/db.php";
include "../phpmailer/PHPMailerAutoload.php";

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


    try {
        //Server settings
        $mail = new PHPMailer();
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'advicebee123@gmail.com';                 // SMTP username
        $mail->Password = 'Advicebee1';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('no-reply@advicebee.com', 'AdviceBee');
        $mail->addAddress($email);     // Add a recipient
    
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'AdviceBee | Question Reported';
        $mail->Body    = "
        The Following Question has been reported.<br><br>
        
        Question ID: $qID <br>
        Owner: $ownerName <br>
        Owner Email: $ownerEmail <br>
    
        Topic: $topic <br>
        Subject: $q_subject <br>
        Description: <br>
        $description <br>
    
        Reported by: $userName <br>
        User ID: $uID <br>
        Email: $userEmail <br><br>
        
        ";
    
        $mail->send();

        echo json_encode("Question has been reported!");
        die();
    
    } catch (Exception $e) {
    
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    
    }    

}
 ?>