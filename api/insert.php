<?php
 include "db.php";

 
 if(isset($_POST['insert']))
 {
    $Description=$_POST['Description'];
    $Subject=$_POST['Subject'];
    $topic=$_POST['topic'];
    $type=$_POST['question_type'];
    $q=mysqli_query($con,"INSERT INTO `Questions` (`Description`,`Subject`,`topic`,`question_type`) VALUES ('$Description','$Subject','$topic','$type')");
    
    if($q)
    echo "success";
    else
    echo "error";
    echo(mysqli_error($con));
 }
 ?>