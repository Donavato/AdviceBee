<?php
 include "../Account/db.php";

 if(isset($_POST['']))
 {
    $topic=$_POST['topic'];
    $q=mysqli_query($con,"INSERT INTO `Questions` (`Description`,`Subject`,`topic`) VALUES ('$Description','$Subject','$topic')");
    
    if($q)
    echo "success";
    else
    echo "error";
 }
 ?>