<?php
 include "db.php";

 
 if(isset($_POST['insert']))
 {
    $Description=$_POST['Description'];
    $Subject=$_POST['Subject'];
    $q=mysqli_query($con,"INSERT INTO `Questions` (`Description`,`Subject`) VALUES ('$Description','$Subject')");
    
    if($q)
    echo "success";
    else
    echo "error";
 }
 ?>