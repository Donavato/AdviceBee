<?php
 include "../Account/db.php";

 header('Content-type: application/json');
 if(isset($_POST['insert']))
 {
    $Description=$_POST['Description'];
    $Subject=$_POST['Subject'];
    $topic=$_POST['topic'];
    $type=$_POST['question_type'];
    $uID = $_SESSION['user_ID'];
   
    $q=mysqli_query($con,"INSERT INTO `Questions` (`user_id` ,`Description`,`Subject`,`topic`,`question_type`) VALUES ('$uID','$Description','$Subject','$topic','$type')");
    
    if($q){
        echo json_encode("success");
        die();
    }
    else{
        echo json_encode("error");
        die();
        echo(mysqli_error($con));
    }
}
 ?>